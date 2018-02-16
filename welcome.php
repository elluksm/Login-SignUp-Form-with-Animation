<?php
//Welcome/profile edit page - when the user have logged in

session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("location: index.php");
    exit;
}


class User
{
    //create User object when reading data from database
    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
}

class AttributeNames
{
    //create AttributeNames object when reading data from database
    public $attribute_id;
    public $field_name;
    public $field_text;
}

class AttributeValues
{
    //create AttributeValues object when reading data from database
    public $id;
    public $user_id;
    public $field_name;
    public $attribute_value;
}

class ReadData
{
    //class for reading data

    //function to read data from User table
    public static function readUserTable($pdo, $user_email)
    {
        $statement = $pdo->prepare("select * from users where email =:email");
        $statement->bindParam(":email", $user_email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetchAll(PDO::FETCH_CLASS, "User");
        return $user;
    }

    //function to read data from AttributeValues table
    public static function readAttributeValuesTable($pdo, $user_id)
    {
        $statement = $pdo->prepare("select * from attribute_values where user_id =:id");
        $statement->bindParam(":id", $user_id, PDO::PARAM_STR);
        $statement->execute();

        $attributeValues = $statement->fetchAll(PDO::FETCH_CLASS, "AttributeValues");
        return $attributeValues;
    }

    //function to read data from AttributeNames table
    public static function readAttributeNamesTable($pdo)
    {
        $statement = $pdo->prepare("select field_name, field_text from attribute_names");
        $statement->execute();
        $attributeNames = $statement->fetchAll(PDO::FETCH_CLASS, "AttributeNames");
        return $attributeNames;
    }
}

class UpdateData
{
    //function to update data in AttributeValues table
    public static function updateAttributeValuesTable($pdo, $attribute_value, $user_id, $field_name)
    {
        $statement = $pdo->prepare("update attribute_values set attribute_value =:attribute_value where (user_id =:id and field_name =:field_name)");
        $statement->bindParam(":attribute_value", $attribute_value, PDO::PARAM_STR);
        $statement->bindParam(":id", $user_id, PDO::PARAM_STR);
        $statement->bindParam(":field_name", $field_name, PDO::PARAM_STR);
        $statement->execute();
    }
}

class InsertData
{
    //function to insert data in AttributeValues table
    public static function insertInAttributeValuesTable($pdo, $attribute_value, $user_id, $field_name)
    {
        $statement = $pdo->prepare("insert into attribute_values(user_id, field_name, attribute_value) values (:user_id, :field_name, :attribute_value)");
        $statement->bindParam(":attribute_value", $attribute_value, PDO::PARAM_STR);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $statement->bindParam(":field_name", $field_name, PDO::PARAM_STR);
        $statement->execute();
    }
}

require "db_connect.php";

$user_email = $_SESSION["email"];
$user_id = $_SESSION["id"];

//read data from all tables
$user = ReadData::readUserTable($pdo, $user_email);
$attributeNames = ReadData::readAttributeNamesTable($pdo);
$attributeValues = ReadData::readAttributeValuesTable($pdo, $user_id);

require "header.php";

?>

<body>
<div class="background-image"></div>
<main class="container">
    <div class="row">
        <div class="dark_background col-md-6 col-md-offset-3 col-sm-12">
            <section class="profile_form">
                <a href="logout.php" class="btn btn-danger uppercase" id="signout">Sign Out</a>
                <h2>Hello, <b><?= $user[0]->username ?>!</b></h2>
                <p>Logged in as <b><?= $_SESSION["email"] ?></b></p><br>
                <div>
                    <h1>Your profile</h1>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php foreach ($attributeNames as $attributeName) {
                            //loop through all attribute names
                            $field_text = $attributeName->field_text;
                            $field_name = $attributeName->field_name;
                            $value = "";

                            //loop through all attribute values for the user who is logged in
                            foreach ($attributeValues as $attributeValue){
                                if ($field_name == $attributeValue->field_name) {
                                    //get attribute value if there already is a value in the AttributeValues table
                                    $value = $attributeValue->attribute_value;
                                }
                            } ?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for=<?= $field_name ?>> <?= $field_text ?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           name=<?= $field_name ?> id= <?= $field_name ?> value= <?= $value ?>>
                                </div>
                            </div>
                        <?php }; ?>

                        <button class="btn uppercase btn-success" name="update" id="update">Update</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
require "footer.php";

//when user clicks Update button
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attributeValues = ReadData::readAttributeValuesTable($pdo, $user_id);

    //loop through all attribute names
    foreach ($attributeNames as $attributeName) {
        $field_name = $attributeName->field_name;
        //get value from POST
        $post_value = trim($_POST["$field_name"]);
        $update = false;

        //for all attribute names check if there was a value already in the AttributeValues table
        foreach ($attributeValues as $attributeValue) {
            if ($field_name == $attributeValue->field_name) {
                $value = $attributeValue->attribute_value;
                //if there was a value - we need update data with new data
                if ($value != $post_value) {
                    UpdateData::updateAttributeValuesTable($pdo, $post_value, $user_id, $field_name);
                    $update = true;
                }
            }
        }

        //if there wasn't a value - we need insert data in the table
        if (!$update) {
            InsertData::insertInAttributeValuesTable($pdo, $post_value, $user_id, $field_name);
        }
    }

    header("location: profile.php");
}

?>

</body>
</html>
