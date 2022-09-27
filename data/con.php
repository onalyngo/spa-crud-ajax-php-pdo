<?php

session_start();
date_default_timezone_set('Europe/Berlin');

$db = new PDO("mysql:host=localhost; dbname=crud", "root", "root");