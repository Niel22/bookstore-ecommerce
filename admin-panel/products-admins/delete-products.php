<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if(isset($_GET['id'])){
    $delete = $conn->prepare("DELETE FROM products WHERE id = :id");
    $delete->bindParam(':id', $_GET['id']);
    $delete->execute();

    if($delete){
    header("location:". ADMINURL."products-admins/show-products.php");
    }
}

?>