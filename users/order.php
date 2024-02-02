<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (!isset($_SESSION['user_id'])) {
    header("location:" . APPURL . "");
}

?>
<?php
if (isset($_SESSION['user_id']) && $_GET['id'] == $_SESSION['user_id']) {

    $select = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY id  DESC");
    $select->bindParam(':user_id', $_SESSION['user_id']);
    $select->execute();

    $orders = $select->fetchAll(PDO::FETCH_OBJ);
} else {
    header("location:" . APPURL . "/404.php");
}

?>
<div class="container-fluid mt-5">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Orders</h5>
                    <table class="table">
                        <?php if (count($orders) > 0): ?>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $order->id; ?>
                                        </th>
                                        <td>
                                            <?= $order->username; ?>
                                        </td>
                                        <td>
                                            <?= $order->email; ?>
                                        </td>
                                        <td>$
                                            <?= $order->price; ?>
                                        </td>
                                        <?php $dateString = "$order->created_at"; // Replace this with your actual date and time string
                                        
                                                $dateTime = new DateTime($dateString);
                                                $formattedDate = $dateTime->format('D, M j, Y g:i A'); ?>
                                        <td>
                                            <?= $formattedDate; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <div class="alert alert-info text-white"> No Orders Yet</div>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php include "../includes/footer.php"; ?>