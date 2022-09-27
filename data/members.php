<?php
error_reporting(E_WARNING);

require_once "con.php";

if(isset($_POST["type"])):
    if( $_POST["type"]=="delete" ):
        $query = $db->prepare( "DELETE FROM members WHERE id=:id" );
        $query->execute([
            "id" => $_POST["id"]
        ]);
        
    endif;
endif;

if(isset($_GET["type"])):
    if( $_GET["type"]=="list" ):
        $query = $db->prepare( "SELECT id, fname, lname, email, created_at FROM members ORDER BY id DESC" );
        $query->execute();

        echo json_encode($query->fetchAll());
    endif;
endif;

if(isset($_GET["type"])):
    if( $_GET["type"]=="edit" ):
        $query = $db->prepare( "SELECT id, fname, lname, email, username, password, address FROM members WHERE id=:id" );
        $query->execute([
            "id" => $_GET["id"]
        ]);

        echo json_encode($query->fetch());
    endif;
endif;
