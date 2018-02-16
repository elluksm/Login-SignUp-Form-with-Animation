<?php

//Registration process, inserts user info into the database

// Validate username
if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a Name.";
} else {
    $username = trim($_POST["username"]);
}

// Validate email
if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email.";
} else {
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE email = :email";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

        // Set parameters
        $param_email = trim($_POST["email"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {

            if ($stmt->rowCount() == 1) {
                $email_err = "This email is already taken.";
            } else {
                $email = trim($_POST["email"]);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);
}

// Validate password
if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
} elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6x characters.";
} else {
    $password = trim($_POST["password"]);
}

if (!empty($username_err) || !empty($password_err) || !empty($email_err)) {
    $register_err = "Sign Up was not successful. Please try again!";
}

// Check input errors before inserting in database
if (empty($username_err) && empty($password_err) && empty($email_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

        // Set parameters
        $param_username = $username;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $success_msg = "Successfully registered, you may login now!";
        } else {
            $register_err = "Something went wrong. Please try again later!";
        }
    }

    // Close statement
    unset($stmt);
}

// Close connection
unset($pdo);
