<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

if(!isset($_SESSION['admin_id'])){
  header("location:".ADMINURL."admins/login-admins.php");
}

?>

<?php

if(isset($_POST["submit"])){
    if(empty($_POST["username"]) OR empty($_POST["email"]) OR empty($_POST["password"])){
        echo "Empty fild detected";
    }else{
        function val($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = val($_POST["username"]);
        $email = val($_POST["email"]);
        $password = val($_POST["password"]);

        $insert = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
        $insert->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        if($insert){
            header("location:".APPURL."admins/admins.php");
        }else{
            echo "Error";
        }
    }
}

?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php include "../layouts/footer.php"; ?>