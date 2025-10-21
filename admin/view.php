<?php 
include('header.php');
?>

<button class="btn btn-success">
  <a href="product.php" class="text-white text-decoration-none">Add Product</a>
</button>


<?php 
    include('conn.php');

    $query = "SELECT * FROM category";
    $run = mysqli_query($conn, $query);
    $totalrows = mysqli_num_rows($run);

    if ($totalrows > 0) {
?>
        <div class="container">
            <div class="rows mt-5">
                <div class="col-md-8 mx-auto">
                    <h1 class="text-center">Products Detail</h1>
                    <table class="table table-bordered text-center mt-5">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
<?php
        while($data = mysqli_fetch_assoc($run)){
            
            echo "
 <tr>
    <td>".$data['id']."</td>
    <td>".$data['name']."</td>
    <td>".$data['description']."</td>
    <td>".$data['price']."</td>
    <td><img src='".$data['img']."' height='50' width='50'></td>
    <td><a class='btn btn-success' href='update.php?id=".$data['id']."&name=".$data['name']."&price=".$data['price']."&description=".$data['description']."&img=".$data['img']."'>Update</a></td>
    <td><a class='btn btn-danger' href='delete.php?id=".$data['id']."'>Delete</a></td>
</tr>";


        }
?>
                    
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<h3 class='text-center mt-5'>The table has no data.</h3>";
    }
?>


<?php 
include('footer.php');
?>
