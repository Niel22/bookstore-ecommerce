<?php include "../config/config.php"; ?>
<?php include "layouts/header.php"; ?>

<?php
if(!isset($_SESSION['admin_id'])){
  header("location:".ADMINURL."admins/login-admins.php");
}
?>
<?php

$selectPro = $conn->query("SELECT * FROM products");
$selectPro->execute();
$products = $selectPro->fetchAll(PDO::FETCH_OBJ);

$selectCat = $conn->query("SELECT * FROM categories");
$selectCat->execute();
$categories = $selectCat->fetchAll(PDO::FETCH_OBJ);

$selectAdmins = $conn->query("SELECT * FROM admins");
$selectAdmins->execute();
$admins = $selectAdmins->fetchAll(PDO::FETCH_OBJ);




?>
    <div class="container-fluid">
            
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of products: <?= count($products); ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?= count($categories); ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?= count($admins); ?></p>
              
            </div>
          </div>
        </div>
      </div>
  
          
    </div>
  </div>
  <?php include "layouts/footer.php"; ?>