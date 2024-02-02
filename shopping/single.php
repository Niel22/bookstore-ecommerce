<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (isset($_POST['submit'])) {
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $pro_image = $_POST['pro_image'];
    $pro_price = $_POST['pro_price'];
    $pro_file = $_POST['pro_file'];
    $pro_amount = $_POST['pro_amount'];
    $user_id = $_POST['user_id'];

    $insert = $conn->prepare("INSERT INTO cart (pro_id, pro_name, pro_image, pro_price, pro_file, pro_amount, user_id) VALUES (:pro_id, :pro_name, :pro_image, :pro_price, :pro_file, :pro_amount, :user_id)");
    $insert->execute([
        ':pro_id' => $pro_id,
        ':pro_name' => $pro_name,
        ':pro_image' => $pro_image,
        ':pro_price' => $pro_price,
        ':pro_file' => $pro_file,
        ':pro_amount' => $pro_amount,
        ':user_id' => $user_id
    ]);
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (isset($_SESSION['username'])) {
        $select = $conn->query("SELECT * FROM cart WHERE pro_id = $product_id AND user_id = $_SESSION[user_id]");
        $select->execute();
    }

    $products = $conn->query("SELECT * FROM products WHERE status = 1 AND id = $product_id");
    $products->execute();

    $product = $products->fetch(PDO::FETCH_OBJ);

    if(!$_GET['id'] == $product->id){
        header("location:".APPURL."/404.php");
    }
} else {
    echo "Error 404";
}
?>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image"
                                    src="<?= APPURL."images/" ?><?= $product->image; ?>" width="250" /> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <a href="#" class="ml-1 btn btn-primary"><i
                                            class="fa fa-long-arrow-left"></i> Back</a> </div> <i
                                    class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3">
                                <h5 class="text-uppercase">
                                    <?= $product->name; ?>
                                </h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">$
                                        <?= $product->price; ?>
                                    </span>
                                </div>
                            </div>
                            <p class="about">
                                <?= $product->description; ?>
                            </p>
                            <form method="post" id="form-data">
                                <div class="">
                                    <input type="hidden" name="pro_id" value="<?= $product->id; ?>" required
                                        class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="pro_name" value="<?= $product->name; ?>" required
                                        class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="pro_image" value="<?= $product->image; ?>" required
                                        class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="pro_price" value="<?= $product->price; ?>" required
                                        class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="pro_amount" value="1" required class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="pro_file" value="<?= $product->file; ?>" required
                                        class="form-control">
                                </div>
                                <div class="">
                                    <input type="hidden" name="user_id"
                                        value="<?= isset($_SESSION['username']) ? $_SESSION['user_id'] : "" ?>" required
                                        class="form-control">
                                </div>
                                <div class="cart mt-4 align-items-center">
                                    <?php if (isset($_SESSION['username'])): ?>
                                        <?php if ($select->rowCount() > 0): ?>
                                            <button id="submit" name="submit" type="submit" disabled
                                                class="btn btn-primary text-uppercase mr-2 px-4"><i
                                                    class="fas fa-shopping-cart"></i> Added to cart</button>
                                        <?php else: ?>
                                            <button id="submit" name="submit" type="submit"
                                                class="btn btn-primary text-uppercase mr-2 px-4"><i
                                                    class="fas fa-shopping-cart"></i> Add to cart</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?= APPURL; ?>auth/login.php"
                                            class="btn btn-secondary text-uppercase mr-2 px-4"><i
                                                class="fas fa-shopping-cart"></i> Login to add product to cart</a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
</body>

</html>
<script>
    $(document).ready(function () {
        $(document).on("submit", function (e) {
            e.preventDefault();
            var formdata = $("#form-data").serialize() + '&submit=submit';

            $.ajax({
                type: "post",
                url: 'single.php?id=<?= $product_id; ?>',
                data: formdata,

                success: function () {
                    alert("added to cart successfully");
                    $("#submit").html("<i class='fas fa-shopping-cart'></i> Added to cart").prop("disabled", true);
                    reload();
                }
            });

            function reload() {


                $("body").load("single.php?id=<?= $product_id; ?>")

            }
        })
    });
</script>