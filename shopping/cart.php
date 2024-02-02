<?php include "../config/config.php"; ?>
<?php include "../includes/header.php"; ?>
<?php
if (isset($_SESSION['username'])) {
  $user_id = $_SESSION['user_id'];

  $products = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");
  $products->execute();

  $allProducts = $products->fetchAll(PDO::FETCH_OBJ);

  if(isset($_POST['submit'])){
    $total_price = $_POST['price'];
    $_SESSION['price'] = $total_price;
    header("location:checkout.php");
  }

  ?>

  <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted">
                      <?= count($allProducts); ?> items
                    </h6>
                  </div>

                  <?php if (count($allProducts) > 0): ?>
                    <table class="table" height="190">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                          <th scope="col">Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total Price</th>
                          <th scope="col">Update</th>
                          <th scope="col"><button value="<?= $user_id; ?>"
                              class="btn-clear btn btn-danger text-white">Clear</button></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($allProducts as $product): ?>
                          <tr class="mb-4">
                            <th scope="row">
                              <?= $product->id; ?>
                            </th>
                            <td><img width="100" height="100" src="<?= APPURL ."images/" ?><?= $product->pro_image; ?>"
                                class="img-fluid rounded-3" alt="<?= $product->pro_name; ?>">
                            </td>
                            <td>
                              <?= $product->pro_name; ?>
                            </td>
                            <td>$<span class="pro_price">
                                <?= $product->pro_price; ?>
                              </span></td>
                            <td><input id="form1" min="1" name="quantity" value="<?= $product->pro_amount; ?>" type="number"
                                class="pro_amount form-control form-control-sm" /></td>
                            <td>$<span class="total_price">
                                <?= $product->pro_price * $product->pro_amount; ?>
                              </span></td>
                            <td><button value="<?= $product->id; ?>" class="btn-update btn btn-warning text-white"><i
                                  class="fas fa-pen"></i> </button></td>
                            <td><button value="<?= $product->id; ?>" class="btn-delete btn btn-danger text-white"><i
                                  class="fas fa-trash-alt"></i> </button></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  <?php else: ?>
                    <p class="text-center bg-success text-white py-3">There are no products in cart.</p>
                  <?php endif; ?>
                  <a href="<?= APPURL; ?>" class="btn btn-success text-white"><i class="fas fa-arrow-left"></i> Continue
                    Shopping</a>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">



                  <form action="cart.php" method="post">
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5 class="full_price"></h5>
                      <input type="hidden" name="price" class="inp_price">
                    </div>

                    <button  type="submit" name="submit" class="btn checkout btn-dark btn-block <?= count($allProducts) == 0 ? "d-none" : ""; ?> btn-lg"
                      data-mdb-ripple-color="dark">Checkout</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <?php include "../includes/footer.php"; ?>

  </body>

  </html>
  <?php
} else {
  header("location:" . APPURL . "");
}
?>
<script>

  $(document).ready(function () {

    $(".pro_amount").mouseup(function () {

      var $el = $(this).closest('tr');



      var pro_amount = $el.find(".pro_amount").val();
      var pro_price = $el.find(".pro_price").html();

      var total = pro_amount * pro_price;
      $el.find(".total_price").html("");

      $el.find(".total_price").append(total);

      $(".btn-update").on('click', function (e) {

        var id = $(this).val();


        $.ajax({
          type: "POST",
          url: "update-item.php",
          data: {
            update: "update",
            id: id,
            pro_amount: pro_amount
          },

          success: function () {
            //  alert("done");
            //   reload();
          }
        })
      });




      fetch();
    });

    $(".btn-delete").on('click', function (e) {

      var id = $(this).val();


      $.ajax({
        type: "POST",
        url: "delete-item.php",
        data: {
          delete: "delete",
          id: id
        },

        success: function () {
          //  alert("done");
          reload();
        }
      })
    });


    $(".btn-clear").on('click', function (e) {

      var id = $(this).val();


      $.ajax({
        type: "POST",
        url: "clear-cart.php",
        data: {
          clear: "clear"
        },

        success: function () {
          alert("done");
          reload();
        }
      })
    });

    fetch();

    function fetch() {

      setInterval(function () {
        var sum = 0.0;
        $('.total_price').each(function () {
          sum += parseFloat($(this).text());
        });
        $(".full_price").html(sum + "$");
        $(".inp_price").val(sum);
        if($(".inp_price".val() > 0)){
          $(".checkout").show();
        }else{
          $(".checkout").hide();
        }
      }, 1000);
    }

    function reload() {


      $("body").load("cart.php")

    }
  });
</script>