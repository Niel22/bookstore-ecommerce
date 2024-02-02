<?php include "../../config/config.php"; ?>
<?php include "../layouts/header.php"; ?>
<?php

?>

<?php
if (isset($_SESSION['admin_id'])) {
  header('location:' . ADMINURL . '');
}


if (isset($_POST["submit"])) {
  if (empty($_POST["email"]) or empty($_POST["password"])) {
    echo "Empty fild detected";
  } else {
    function val($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $email = val($_POST["email"]);
    $password = val($_POST["password"]);

    $login = $conn->prepare("SELECT * FROM admins WHERE email = '$email'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    if ($login->rowCount() > 0) {

      if (password_verify($password, $fetch['password'])) {
        $_SESSION['admin_id'] = $fetch['id'];
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        session_start();
        header("location: " . ADMINURL . "");

        echo "<script>alert('right')</script>";
      } else {
        echo "Incorrect credentials";
      }
    } else {
      echo "Incorrectv Credentials";
    }
  }
}

?>
<div class="container mt-5">


  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="login-admins.php" method="POST" class="form-control mt-5">
        <h4 class="text-center mt-3"> Login </h4>

        <div class="">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="">
            <input type="email" name="email" required class="form-control" id="" value="">
          </div>
        </div>
        <div class="">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
          <div class="">
            <input type="password" name="password" required class="form-control" id="inputPassword">
          </div>
        </div>
        <button name="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">login</button>

      </form>
    </div>
  </div>



</div>