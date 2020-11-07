<?php 
ini_set('display_errors', 1);

require_once 'autoload.php';
use classes\Student as Student;

if(isset($_GET['student'])){

    $studentId = $_GET['student'];

    $student = new Student($studentId);

    $student->get();
} else {
    echo '<h1>SCHOOL BOARD TEST</h1>';
}
?>