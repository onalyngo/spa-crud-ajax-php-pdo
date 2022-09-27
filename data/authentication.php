<?php
require_once "con.php";

$query = $db->prepare("SELECT * FROM members WHERE username=:user");
$query->execute(
    [
        "user" => $_POST["username"]
    ]
);

if( $query->rowCount()>0 ):
    $row = $query->fetch();
    if( password_verify( $_POST["password"], $row["password"]) ):
        $_SESSION["user"] = $row["id"];
        $_SESSION["CSRF_TOKEN"] = md5(uniqid().date("Y-m-d H:i:s"));

        header("location: ../members.php");
    else:
        header("location: ../login.php");
    endif;
else:
    header("location: ../login.php");
endif;