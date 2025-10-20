<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKSAW - Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  
</head>
<body>
    <div class="signup-container">
        <div class="text-center">
            	<a href="index.html"><img src="images/main-logo.png" alt="logo"></a>
            <p class="subtitle">Sign in to continue</p>
        </div>
        
<<<<<<< HEAD
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name='fname' class="form-control" id="name" placeholder="Enter your name" required>
=======
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
>>>>>>> 4a6b7625e60e1e37152986f9200a47e9425557b8
            </div>
            
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
<<<<<<< HEAD
                <input type="text" name='lname' class="form-control" id="lastName" placeholder="Enter your last name" required>
=======
                <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" required>
>>>>>>> 4a6b7625e60e1e37152986f9200a47e9425557b8
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
<<<<<<< HEAD
                <input type="email" name='email' class="form-control" id="email" placeholder="Enter your email" required>
=======
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
>>>>>>> 4a6b7625e60e1e37152986f9200a47e9425557b8
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
<<<<<<< HEAD
                <input type="password" name='password' class="form-control" id="password" placeholder="Create a password" required>
            </div>
            
            <button type="submit" name='signup' class="btn btn-signup btn-dark">Sign Up</button>
=======
                <input type="password" class="form-control" id="password" placeholder="Create a password" required>
            </div>
            
            <button type="submit" class="btn btn-signup btn-dark">Sign Up</button>
>>>>>>> 4a6b7625e60e1e37152986f9200a47e9425557b8
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
<<<<<<< HEAD
</html>
<?php
include("admin/conn.php");
if(isset($_POST['signup'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "insert into signup (firstname, lastname, email, password)
    values('$fname', '$lname', '$email', '$password')";
    $run = mysqli_query($conn, $query);
    if($run) {
        header('location:login.php');
    }
    else{
        echo 'data not edit';
    }
}
?>
=======
</html>
>>>>>>> 4a6b7625e60e1e37152986f9200a47e9425557b8
