<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php


$selectCategory = $conn->query("SELECT * FROM categories");
$selectCategory->execute();

$categories = $selectCategory->fetchAll(PDO::FETCH_OBJ);
?>


<?php
if (isset($_POST["submit"])) {
  if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_FILES["image"])) {
    echo "Empty fild detected";
  } else {
    function val($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $name = val($_POST["name"]);
    $price = val($_POST["price"]);
    $category = $_POST["category"];
    $description = val($_POST["description"]);
    $image = $_FILES["image"];
    $file = $_FILES["file"];

    $select = $conn->prepare("SELECT * FROM categories WHERE name = :category");
    $select->bindParam(':category', $category);
    $select->execute();

    $categories_id = $select->fetch(PDO::FETCH_OBJ);
    $category_id = $categories_id->id;

    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];

    $imageDiv = explode('.', $imageName);
    $imageExt = strtolower(end($imageDiv));

    $extList = array('jpeg', 'jpg', 'png');
    if (in_array($imageExt, $extList)) {
      $imageUrl = $name . '.' . $imageExt;
      $imagePath = "../../images/" . $imageUrl;
      $movedImage = move_uploaded_file($imageTempName, $imagePath);
      if ($movedImage) {
        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];

        $fileDiv = explode('.', $fileName);
        $fileExt = strtolower(end($fileDiv));

        $fileExtList = array('pdf', 'docx');
        if (in_array($fileExt, $fileExtList)) {
          $fileUrl = $name . '.' . $fileExt;
          $filePath = "../../books/" . $fileUrl;
          $moved = move_uploaded_file($fileTempName, $filePath);
          if ($moved) {

            $insert = $conn->prepare("INSERT INTO products (name, description, image, file, price, category_id) VALUES (:name, :description, :image, :file, :price, :category_id)");
            $insert->execute([
              ':name' => $name,
              ':description' => $description,
              ':image' => $imageUrl,
              ':file' => $fileUrl,
              ':price' => $price,
              ':category_id' => $category_id
            ]);

            if ($insert) {
              header("location:" . ADMINURL . "products-admins/show-products.php");
            } else {
              header("location:" . ADMINURL . "products-admins/");
            }
          } else {
            header("location:" . ADMINURL . "");
          }
        }

      }
    }
  }


}

?>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Products</h5>
          <form method="POST" action="create-products.php" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <label>Name</label>

              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            </div>

            <div class="form-outline mb-4 mt-4">
              <label>Price</label>

              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" placeholder="description" class="form-control"
                id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Select Category</label>

              <select name="category" class="form-control" id="exampleFormControlSelect1">
                <option>--select category--</option>
                <?php foreach($categories as $category) :?>
                <option>
                  <?= $category->name; ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-outline mb-4 mt-4">
              <label>Image</label>

              <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>

            <div class="form-outline mb-4 mt-4">
              <label>File</label>
              <input type="file" name="file" id="form2Example1" class="form-control" placeholder="file" />
            </div>


            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


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