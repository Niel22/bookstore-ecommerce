<?php require "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>

<?php
if (isset($_GET['id'])) {
    $rows = $conn->query("SELECT * FROM products WHERE status = 1 AND category_id = $_GET[id]");
    $rows->execute();

    $allRows = $rows->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="row mt-5">
        <?php foreach ($allRows as $product): ?>
            <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                <div class="card">
                    <img height="213px" class="card-img-top" src="<?= APPURL."images/" ?><?= $product->image; ?>">
                    <div class="card-body">
                        <h5 class="d-inline"><b>
                                <?= $product->name; ?>
                            </b> </h5>
                        <h5 class="d-inline">
                            <div class="text-muted d-inline">($
                                <?= $product->price; ?>/item)
                            </div>
                        </h5>
                        <p>
                            <?= substr($product->description, 0, 40); ?>
                        </p>
                        <a href="<?= APPURL ?>shopping/single.php?id=<?= $product->id; ?>"
                            class="btn btn-primary w-100 rounded my-2"> More<i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <br>
    </div>

</div>
<?php }else{
    header("location:".APPURL."");
}
 ?>

<?php include "../includes/footer.php"; ?>