<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if(!isset($_SESSION['admin_id'])){
  header("location:".ADMINURL."admins/login-admins.php");
}

if(isset($_GET['id'])){
  $selectPro = $conn->prepare("SELECT * FROM products WHERE id = :id");
  $selectPro->bindParam(':id', $_GET['id']);
  $selectPro->execute();

  $productsStatus = $selectPro->fetch(PDO::FETCH_OBJ);
  if($productsStatus->status == 0){
    $verify = $conn->prepare("UPDATE products SET status = 1 WHERE id = :id");
    $verify->bindParam(':id', $_GET['id']);
    $verify->execute();

    header("locaton:". ADMINURL."products-admins/show-products.php");
  }else{
    $unverify = $conn->prepare("UPDATE products SET status = 0 WHERE id = :id");
    $unverify->bindParam(':id', $_GET['id']);
    $unverify->execute();

    header("locaton:". ADMINURL."products-admins/show-products.php");
  }
}

?>
<?php

$select = $conn->query("SELECT * FROM products");
$select->execute();

$products = $select->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid mt-5">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Products</h5>
              <a  href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Create Products</a>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">product</th>
                    <th scope="col">price in $$</th>
                    <th scope="col">category</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($products as $product) :  ?>
                  <tr>
                    <th scope="row"><?= $product->id; ?></th>
                    <td><?= $product->name; ?></td>
                    <td><?= $product->price; ?></td>
                    <td><?= $product->category_id; ?></td>
                    <?php if($product->status == 1) : ?>
                     <td><a href="<?= ADMINURL;?>products-admins/show-products.php?id=<?= $product->id;?>" class="btn btn-success  text-center ">Verfied</a></td>
                    <?php else:?>
                      <td><a href="<?= ADMINURL;?>products-admins/show-products.php?id=<?= $product->id;?>" class="btn btn-warning  text-center ">Unverfied</a></td>
                    <?php endif;?>
                     <td><a href="<?= ADMINURL;?>products-admins/delete-products.php?id=<?= $product->id;?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
<script type="text/javascript">

</script>
</body>
</html>