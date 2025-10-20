<?php 
  $conn = mysqli_connect("localhost", "root", "", "booksaw");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
