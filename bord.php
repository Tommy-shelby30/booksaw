<?php 
include('header.php');

?>

<main class="main">

<section id="latest-products" class="product-store py-2 my-2 py-md-5 my-md-5 pt-0">
  <div class="container section-title" data-aos="fade-up">
    <h2>Bords</h2>
  </div>

  <div class="container-md">
  <div class="product-content padding-small">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-5">
      <?php 
        include('admin/conn.php');

        $query = "SELECT * FROM books WHERE books = 'bords' ";
        $run = mysqli_query($conn, $query);

        if (!$run) {
            echo "<p>❌ Error: " . mysqli_error($conn) . "</p>";
        } else {
            $totalrows = mysqli_num_rows($run);

            if ($totalrows > 0) {
                while($data = mysqli_fetch_assoc($run)) {
                  ?>
                    <div class="col">
                      <div class="card shadow-md border-0 rounded-3 h-100">
                        <img src="admin/<?php echo $data['Image']; ?>" 
                             class="card-img-top rounded-top" 
                             alt="Product Image" 
                             style="height:200px; width:100%; object-fit:cover;">
                        <div class="card-body text-center">
                          <h5 class="card-title fw-bold"><?php echo $data['name']; ?></h5>
                          <p class="card-text text-muted mb-3"><strong><?php echo $data['price']; ?></strong></p>
                           <form action="add_to_cart.php" method="POST">
                  <input type="hidden" name="name" value="<?php echo $data['name']; ?>">
                  <input type="hidden" name="price" value="<?php echo $data['price']; ?>">
                  <input type="hidden" name="image" value="Admin/<?php echo $data['Image']; ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Add to Cart</button>
                </form>
                        </div>
                      </div>
                    </div>
                  <?php
                }
            } else {
                echo "<h3 class='text-center mt-5'>Not found</h3>";
            }
        }
      ?>
    </div>
  </div>
</div>
</section>

</main>


 <?php 
  include('footer.php');
  ?>