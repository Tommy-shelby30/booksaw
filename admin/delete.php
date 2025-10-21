<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php 
    include('conn.php');

    $id = $_GET['id']??"";
    $query = "delete from category where id ='$id' ";
    $run = mysqli_query($conn, $query);
    if($run){
        echo "<script>
                alert('Data has been deleted successfully');
                window.location.href = 'view.php';
              </script>";
    }else{
        echo "data no deleted";
    }
    
    
    ?>
</body>
</html>