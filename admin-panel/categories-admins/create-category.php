<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if(!isset($_SESSION['admin_id'])){
  header("location:".ADMINURL."admins/login-admins.php");
}

?>
<?php

if(isset($_POST["submit"])){
  if(empty($_POST["name"]) || empty($_POST["description"]) || empty($_FILES["image"])){
      echo "Empty fild detected";
  }else{
      function val($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }

      $name = val($_POST["name"]);
      $description = val($_POST["description"]);
      $image = $_FILES["image"];

      $fileName = $image['name'];
      $fileTempName =  $image['tmp_name'];

      $fileDiv = explode('.', $fileName);
      $fileExt = strtolower(end($fileDiv));

      $extList = array('jpeg', 'jpg', 'png');
      if(in_array($fileExt, $extList)){
        $fileUrl = $name . '.'. $fileExt;
        $filePath = "../../images/". $fileUrl;
        $moved = move_uploaded_file($fileTempName, $filePath);
        if($moved){
          $insert = $conn->prepare("INSERT INTO categories (name, description, image) VALUES (:name, :description, :image)");
          $insert->execute([
              ':name' => $name,
              ':description' => $description,
              ':image' => $fileUrl
          ]);
    
          if($insert){
              header("location:".ADMINURL."categories-admins/show-categories.php");
          }else{
              echo "Error";
          }
        }else{
          echo "Error";
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
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="description" id="form2Example1" class="form-control" placeholder="description" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" />
                 
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