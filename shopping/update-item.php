<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (isset($_POST['update'])) {
    $id = ($_POST['id']);
    $pro_amount = ($_POST['pro_amount']);
    $update = $conn->query("UPDATE cart SET pro_amount = $pro_amount WHERE id = $id");
    $update->execute();

}
?>
<?php include "../includes/footer.php"; ?>