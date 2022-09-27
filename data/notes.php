<?php
require_once "con.php";

if( $_POST["csrf"]!=$_SESSION["CSRF_TOKEN"] ):
    header("HTTP/1.0 404 Not Found");
    exit;
endif;


$query = $db->prepare("INSERT INTO personal_notes(user_id, title, content) VALUES(:user_id, :title, :content)");

$query->execute(
    [
        "user_id" => $_SESSION["user"],
        "title" => $_POST["title"],
        "content" => addslashes($_POST["content"])
    ]
);

header("location: ../notes.php");