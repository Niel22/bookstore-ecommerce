<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if (!isset($_SESSION['admin_id'])) {
  header("location:" . ADMINURL . "admins/login-admins.php");
}

?>
<?php

if (isset($_GET["id"])) {
  $id = $_GET['id'];

  $select = $conn->prepare("SELECT * FROM categories WHERE id = $id");
  $select->execute();

  $category = $select->fetch(PDO::FETCH_OBJ);

  if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $update = $conn->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
    $update->bindParam(":name", $name);
    $update->bindParam(":description", $description);
    $update->bindParam(":id", $id);
    $update->execute();

    if ($update) {
      header("location:" . ADMINURL . "categories-admins/show-categories.php");
    } else {
      echo "Error";
    }
  } else {
    echo "Error";
  }
}




?>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?id=<?= $category->id; ?>" enctype="multipart/form-data">
            <!-- Email input -->

            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" value="<?= $category->name; ?>" id="form2Example1" class="form-control"
                placeholder="name" />

            </div>
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="description" value="<?= $category->description; ?>" id="form2Example1"
                class="form-control" placeholder="description" />

            </div>


            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

</script>
</body>

</html>