<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php require "../vendor/autoload.php"; ?>
<?php

if (isset($_POST['email'])) {

    \Stripe\Stripe::setApiKey($stripe_secret_key);

    $charge = \Stripe\Charge::create([
        'source' => $_POST['stripeToken'],
        'amount' => $_SESSION['price'] * 100,
        'currency' => 'usd',
    ]);

    echo "paid";


    if (empty($_POST["fname"]) or empty($_POST["lname"]) or empty($_POST["username"])) {
        echo "Empty fild detected";
    } else {
        $price = $_SESSION['price'];
        $user_id = $_SESSION['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $token = $_POST['stripeToken'];

        $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, token, price, user_id) VALUES (:email, :username, :fname, :lname, :token, :price, :user_id)");
        $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':fname' => $fname,
            ':lname' => $lname,
            ':token' => $token,
            ':price' => $price,
            ':user_id' => $user_id

        ]);
    }

    header("location:".APPURL."/download.php?token=$token");
}


?>
<?php include "../includes/footer.php" ?>