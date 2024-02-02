<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    
    header("location:../404.php");
    die;
}

$host = "localhost";
$dbname = "bookstore";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stripe_secret_key = "sk_test_51OdfV3J3Z02KmYncODuOvkk9KKcwUSX3vIvAkbVVZEGzeeJNaEXo8n9Z7iA9w8L5bGLzcXolRTnVBu88yGP1Au1h006x9KrKkP";
?>