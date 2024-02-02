<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if (isset($_GET["id"])) {

    $select = $conn->query("SELECT * FROM categories WHERE id = $_GET[id]");
    $select->execute();

    $image = $select->fetch(PDO::FETCH_OBJ);
    unlink("../../books/".$image->image."");

    $delete = $conn->prepare("DELETE  FROM categories WHERE id = $_GET[id]");
    $delete->execute();
    header("location:" . ADMINURL . "categories-admins/show-categories.php");}

?>