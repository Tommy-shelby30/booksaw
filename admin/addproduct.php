
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
</head>
<body>
<?php 
include('conn.php');

if (isset($_POST['submitproduct'])) {

    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    

    
    $imgname = $_FILES['uploadimg']['name'];
    $imgsize = $_FILES['uploadimg']['size'];
    $imgtype = $_FILES['uploadimg']['type'];
    $imgtemp = $_FILES['uploadimg']['tmp_name'];
    $storage = "images/";

    
    if(empty($imgname)){
        die("Image not selected. Please upload an image.");
    }

    
    if (strtolower(pathinfo($imgname, PATHINFO_EXTENSION)) == 'png' || 
        strtolower(pathinfo($imgname, PATHINFO_EXTENSION)) == 'jpg' ||
        strtolower(pathinfo($imgname, PATHINFO_EXTENSION)) == 'jfif' ||
        strtolower(pathinfo($imgname, PATHINFO_EXTENSION)) == 'jpeg') {

        if ($imgsize <= 1000000) {
            $storage = "images/" . basename($imgname);

            
            $query = "INSERT INTO author (name, price, description, img) 
                      VALUES ('$name', '$price','$description', '$storage')";

            $run = mysqli_query($conn, $query);

            if ($run) {
                if (move_uploaded_file($imgtemp, $storage)) {
                    echo "<script>
                            alert('Data has been inserted successfully');
                            window.location.href='view.php';
                          </script>";
                } else {
                    echo "Image upload failed.";
                }
            } else {
                echo "Data not inserted successfully: " . mysqli_error($conn);
            }
        } else {
            echo "Image size must be less than 1MB.";
        }
    } else {
        echo "Invalid file type. Only PNG, JPG, JPEG are allowed.";
    }
}
?>
</body>
</html>
