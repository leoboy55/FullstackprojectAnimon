<?php

require_once("../db/db_connection.php");
session_start();
$error = false;

//register user into db
if (isset($_POST['register'])) {
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conn = newcon();
    $query = "INSERT INTO account (email, nickname, password) VALUES ('$email', '$nickname', '$password')";

    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $_SESSION["userSession"] = $nickname;
    $_SESSION["userEmail"] = $email;

    $query2 = "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 6, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 7, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 8, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 9, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 10, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 11, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 12, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 13, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 14, 0, 0);";
    $query2 .= "INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) 
VALUES ('" . $_SESSION["userEmail"] . "', 15, 0, 0);";
    if ($conn->multi_query($query2) === TRUE) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $query2 . "<br>" . $conn->error;
    }
    $conn->close();
    header("location: ../homepage/index.php");
}
//log in user
if(isset($_POST['email-l']) && isset($_POST['password-l'])){
    $emailUser = $_POST['email-l'];
    $passwordUser = $_POST['password-l'];
    $conn = newcon();
    $querylogin = "SELECT email, password, nickname FROM account WHERE email = '$emailUser' AND password = '$passwordUser'";
    $result = $conn->query($querylogin);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "email: " . $row["email"]. " - ww: " . $row["password"]. "  -naam: " . $row["nickname"]. "<br>";
            $_SESSION["userSession"] = $row["nickname"];
            $_SESSION["userEmail"] = $row["email"];
            header("location: ../homepage/index.php");
        }
    } else {
        header("location: registerpage.php");
        $error = true;
        $_SESSION["error"] = $error;
    }
    $conn->close();
}


