<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if(!isset($_SESSION['admin_id'])){
  header("location:".ADMINURL."admins/login-admins.php");
}

?>
<?php

$select = $conn->query("SELECT * FROM admins");
$select->execute();

$admins = $select->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid mt-5">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($admins as $admin) :  ?>
                  <tr>
                    <th scope="row"><?= $admin->id; ?></th>
                    <td><?= $admin->username; ?></td>
                    <td><?= $admin->email; ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



      <?php include "../layouts/footer.php"; ?>