<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (isset($_POST['delete'])) {
    $id = ($_POST['id']);
    $delete = $conn->query("DELETE FROM cart WHERE id = $id");
    $delete->execute();

}
?>
<?php include "../includes/footer.php"; ?>