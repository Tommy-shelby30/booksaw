<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKSAW - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="login-container">
        <div class="text-center">
            <a href="index.html"><img src="images/main-logo.png" alt="logo"></a>
            <p class="subtitle">Login in to continue</p>
        </div>
        

        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>

       
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" name="submit" class="btn btn-login btn-dark">Login</button>

          
            
            
            

        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
session_start();
include('admin/conn.php');

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM signup1 WHERE email = '$email' AND password = '$password'";
    $run = mysqli_query($conn, $query);
    $totalrows = mysqli_num_rows($run);

    if ($totalrows != 0) {
        $data = mysqli_fetch_assoc($run);

        
        $_SESSION['user_id'] = $data['id'];       
        $_SESSION['user_name'] = $data['name'] ?? $data['email']; 

        if ($email == 'admin@gmail.com' && $password == 'admin123') {
            header('Location: admin/dashboard.php');
            exit();
        } else {
            header('Location: index.php');  
            exit();
        }
    } else {
        echo "Data not found";
    }
}
?>



</html>

