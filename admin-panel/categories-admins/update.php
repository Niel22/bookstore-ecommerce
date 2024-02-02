<?php

if (isset($_POST["submit"]) && isset($_GET["id"])) {

    function val($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  
    $name = val($_POST["name"]);
    $description = val($_POST["description"]);
  
    $update = $conn->query("UPDATE categories SET name = $name, description = $description WHERE id = '$_GET[id]'");
    $update->execute();
  
    if ($update) {
      header("location:" . ADMINURL . "categories-admins/show-categories.php");
    } else {
      echo "Error1";
    }
  } else {
    echo "Error2";
  }

?>