<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <?php 
     include('conn.php');

     $id1 = $_GET['id']??"";
     $name1 = $_GET['name']??"";
     $description1 = $_GET['description']??"";
     $price1 = $_GET['price']??"";
     $image1 = $_GET['img']??"";
    
    ?>

<div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <form action="addproduct.php" method='POST' enctype="multipart/form-data">
                    
                <input type="hidden" name='name' class="form-control" id="" placeholder="Product Name" value=<?php echo $id1?>><br>

                    <label for="" class='form-label'>Name</label><br>
                    <input type="text" name='name' class="form-control" id="" placeholder="Product Name" value=<?php echo $name1?>><br>

                    <label for="" class='form-label'>Price</label><br>
                    <input type="text" name='price' class="form-control" id="" placeholder="Product Price" value=<?php echo $price1?>><br>

                    <label for="" class='form-label'>Description</label><br>
                    <input type="text" name='description' class="form-control" id="" placeholder="description" value=<?php echo $description1?>><br>

                    <label for="" class='form-label'>Image</label><br>
                    <input type="file" name='uploadimg' class="form-control" id="" value=<?php echo $image1?>><br>
                    <input type="submit" value='add Product' name='submitproduct' class="btn btn-success mt-5">
                </form>
            </div>
        </div>
    </div>  

    <?php if(isset($_POST['updateproduct'])){ 
        $id2 = $_POST['id']; 
        $name2 = $_POST['name'];
        $description2 = $_POST['description'];
        $price2 = $_POST['price']; 
        $imgname = $_FILES['uploadimg']['name']; 
        $imgtype = $_FILES['uploadimg']['type']; 
        $imgsize = $_FILES['uploadimg']['size']; 
        $imgtemp = $_FILES['uploadimg']['tmp_name']; 
        $storage = "images/"; 

        if(is_uploaded_file($_FILES['uploadimg']['tmp_name'])){ 
            if(strtolower($imgtype == "image/png") || strtolower($imgtype == "image/jpg")||strtolower($imgtype == "image/jpeg")){ 
                if($imgsize >= 1000000){ 
                    $storage = "images/" . $imgname; 
                    $query = "update products set name= '$name2', products= '$products2', price= '$price2', description= '$description2', Image='$storage' where id ='$id2' ";

                     if(move_uploaded_file($imgtemp, $storage)){
                        $run = mysqli_query($conn, $query);
                        if($run){
                        // success
                            }
                        } else {
                     echo "Failed to upload image.";
                    } 
                     if($run){ 
                        echo "<script> alert('Data has been updated successfully with image'); window.location.href = 'category.php'; </script>"; 
                        }else{ echo "data not successfully updated"; } 
                        } 

                        }else{ echo "image type is not valid";
                         }
                         
                         }else{ $query = "update products set name= '$name2', products= '$products2', price= '$price2', description= '$description2', Image='$storage' where id ='$id2' "; 
                            $run = mysqli_query($conn, $query); 
                            move_uploaded_file($imgtemp,$storage);
                          if($run){ 
                            echo "<script> alert('Data has been updated successfully without image'); window.location.href = 'category.php'; </script>";
                            }else{
                                 echo "image not uploaded";
                                  } 
                                  } 
                                  } ?>

</body>
</html>
