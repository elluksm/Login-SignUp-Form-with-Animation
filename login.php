<?php
//Login process

// Check if email is empty
if (empty(trim($_POST["email"]))) {
    $lg_email_err = 'Please enter email.';
} else {
    $email = trim($_POST["email"]);
}

// Check if password is empty
if (empty(trim($_POST["password"]))) {
    $lg_password_err = "Please enter your password.";
} else {
    $password = trim($_POST["password"]);
}

// Validate credentials
if (empty($lg_email_err) && empty($lg_password_err)) {
    // Prepare a select statement
    $sql = "SELECT email, password, id FROM users WHERE email = :email";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

        // Set parameters
        $param_email = trim($_POST["email"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Check if email exists, if yes then verify password
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $hashed_password = $row["password"];
                    if (password_verify($password, $hashed_password)) {
                        /* Password is correct, so start a new session and
                        save email to the session */
                        session_start();
                        $id = $row["id"];
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $id;
                        header("location: welcome.php");
                    } else {
                        // Display an error message if password is not valid
                        $lg_password_err = "The password you entered was not valid.";
                    }
                }
            } else {
                // Display an error message if email doesn't exist
                $lg_email_err = "No account found with that email.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);
}

// Close connection
unset($pdo);

?>

