<?php require "../config/config.php";?>
<?php include "../includes/header.php";?>

<?php

if(isset($_SESSION['username'])){
    header('location:'.APPURL.'');
}

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

        $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $insert->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        if($insert){
            header('location: login.php');
        }else{
            echo "Error";
        }
    }
}

?>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="register.php" method="POST" class="form-control mt-5">
                    <h4 class="text-center mt-3"> Register </h4>
                    <div class="">
                        <label for="" class="col-sm-2 col-form-label">Username</label>
                        <div class="">
                            <input type="text" name="username" required class="form-control" id="" value="">
                        </div>
                    </div>
                    <div class="">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="">
                            <input type="email" name="email" required  class="form-control" id="" value="">
                        </div>
                    </div>
                    <div class="">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="">
                            <input type="password" name="password" required class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-4" name="submit" type="submit">register</button>

                </form>
            </div>
        </div>
 
   

        </div>
        <?php include "../includes/footer.php";?>
  </body>
 
</html>