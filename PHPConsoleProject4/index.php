<?php

require_once "Student.Class.php";
require_once "Database.Class.php";

echo "Hello World!";

$database = new Database("localhost", "test", "root", "");

$a = new Student();
$a->Name = "Bert";
$a->Email = "bert@ddigit.nl";


echo $a->Name;

$a->Save($database);

$database->Save("student", $a);