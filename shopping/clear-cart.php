<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (isset($_POST['clear'])) {

    $clear = $conn->query("DELETE FROM cart WHERE user_id = $_SESSION[user_id]");
    $clear->execute();

}
?>
<?php include "../includes/footer.php"; ?>