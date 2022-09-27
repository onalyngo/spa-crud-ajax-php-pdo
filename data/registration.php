<?php
require_once "con.php";
/*
if( empty($_POST["lname"]) || empty($_POST["fname"]) || 
    empty($_POST["email"]) || empty($_POST["password1"]) || empty($_POST["username"]) ):

    header("HTTP/1.0 404 Not Found");
    exit;
endif;


if( $_POST["password1"]!=$_POST["password2"] ):
    //header("location:../register.php");
endif;
*/
/*
if( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ):
    //header("location: ../register.php");
endif;
*/
if(isset($_POST["id"])):
    $query = $db->prepare("UPDATE members SET fname=:fname, lname=:lname, email=:email WHERE id=:id");

    $query->execute(
        [
            "fname" => !empty($_POST["fname"]) ? $_POST["fname"] : "",
            "lname" => !empty($_POST["lname"]) ? $_POST["lname"] : "",
            "email" => !empty($_POST["email"]) ? $_POST["email"] : "",
            "id" => $_POST["id"]
        ]
    );
else:
    $query = $db->prepare("INSERT INTO members(fname, lname, email, address, username, password) 
                        VALUES( :fname, :lname, :email, :address, :user, :pass )");

    $query->execute(
        [
            "fname" => !empty($_POST["fname"]) ? $_POST["fname"] : "",
            "lname" => !empty($_POST["lname"]) ? $_POST["lname"] : "",
            "email" => !empty($_POST["email"]) ? $_POST["email"] : "",
            "address" => !empty($_POST["address"]) ? $_POST["address"] : "",
            "user" => !empty($_POST["username"]) ? $_POST["username"] : "",
            "pass" => !empty($_POST["password1"]) ? password_hash($_POST["password1"], PASSWORD_DEFAULT) : ""
        ]
    );
endif;
//header("location: ../register.php?success=1");
