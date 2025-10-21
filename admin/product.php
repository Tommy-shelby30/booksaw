<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <form action="addproduct.php" method='POST' enctype="multipart/form-data">

    <input type="hidden" name='id' class="form-control" value="<?php echo isset($id1) ? $id1 : '' ?>"><br>

<label for="" class='form-label'>Name</label><br>
<input type="text" name='name' class="form-control" placeholder="Product Name" value="<?php echo isset($name1) ? $name1 : '' ?>"><br>

<label for="" class='form-label'>Price</label><br>
<input type="text" name='price' class="form-control" placeholder="Product Price" value="<?php echo isset($price1) ? $price1 : '' ?>"><br>

<label for="" class='form-label'>Description</label><br>
<input type="text" name='description' class="form-control" placeholder="Description" value="<?php echo isset($description1) ? $description1 : '' ?>"><br>

<label for="" class='form-label'>Image</label><br>
<input type="file" name='uploadimg' class="form-control"><br>

 <input type="submit" value='add Product' name='submitproduct' class="btn btn-success mt-5">


             </form>
            </div>
        </div>
    </div>  

</body>
</html>