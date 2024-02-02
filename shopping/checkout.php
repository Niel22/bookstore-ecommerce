<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php

if (isset($_SESSION['user_id'])) {

  $select = $conn->query("SELECT * FROM cart WHERE user_id = $_SESSION[user_id]");
  $select->execute();

  $allProducts = $select->fetchAll(PDO::FETCH_OBJ);

  if (count($allProducts) > 0) {

    ?>
    <div class="container">
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout</h2>

      <!--Grid row-->
      <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form method="post" action="charge.php" class="card-body">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form">
                    <label for="firstName" class="">First name</label>

                    <input type="text" required name="fname" id="firstName" class="form-control">
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->
                  <div class="md-form">
                    <label for="lastName" class="">Last name</label>

                    <input type="text" required name="lname" id="lastName" class="form-control">
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="md-form mb-5">
                <label for="email" class="">Username</label>

                <input type="text" value="<?= $_SESSION['username']; ?>" required name="username" class="form-control" placeholder="Username"
                  aria-describedby="basic-addon1">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <label for="email" class="">Email</label>

                <input type="text" value="<?= $_SESSION['email']; ?>" required name="email" id="email" class="form-control"
                  placeholder="youremail@example.com">
              </div>




              <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51OdfV3J3Z02KmYncLJ5hxbvgi0Uajy4KakGPsbUb2WFvYWz5OJZcKnmtk26nzHuozdnJtsqL3mSDplSgriNi4w8400syyuLHSH"
                data-currency="usd" data-pay="pay now"></script>

            </form>

          </div>

        </div>
      </div>
    </div>

    <?php include "../includes/footer.php" ?>
    </body>

    </html>
    <?php

  } else {
    header("location:" . APPURL . "/shopping/cart.php");
  }

} else {
  header("location:" . APPURL . "/shopping/cart.php");
}