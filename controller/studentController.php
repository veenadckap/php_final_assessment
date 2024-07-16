<?php

$db = require("../model/DB.php");
$config = require('../config.php');
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if(isset($_POST['name'], $_POST['standard'], $_POST['roll_number'] ,$_POST['dob'])) {
    $name = $_POST['name'];
    $standard = $_POST['standard'];
    $roll_number = $_POST['roll_number'];
    $dob = $_POST['dob'];
  
  
    $sql = "INSERT INTO students (name, standard, roll_number,dob ) VALUES ('$name', '$standard', '$roll_number' ,'$dob')";
    if ($conn->query($sql) === TRUE) {
        header("Location:../view/students_form");
        exit; 
    } else {
        echo "Error:  failed";
    }
} else {
    echo "Invalid input data";
}

$conn->close();

?>
