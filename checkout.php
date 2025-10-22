<?php
session_start();
include('Admin/conn.php');

if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit();
}

$user_name = $_SESSION['user_name'] ?? "Unknown User";
$total = 0;


if(!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0){
  echo "<script>alert('Your cart is empty!'); window.location.href='index.php';</script>";
  exit();
}


if(isset($_POST['confirm_order'])){
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $postal = $_POST['postal'];

  foreach($_SESSION['cart'] as $item){
    $name = $item['name'];
    $price = $item['price'];
    $qty = $item['quantity'];
    $subtotal = $price * $qty;

    $insert = "INSERT INTO orders (customer_name, email, phone, address, city, postal_code, product_name, product_price, quantity, subtotal)
               VALUES ('$user_name', '$email', '$phone', '$address', '$city', '$postal', '$name', '$price', '$qty', '$subtotal')";
    mysqli_query($conn, $insert);
    $total += $subtotal;
  }

  
  $to = "faiezashrad27@gmail.com";
  $subject = "New Order Received from $user_name";
  $message = "New order placed by $user_name.\n\nOrder Details:\n";

  foreach($_SESSION['cart'] as $item){
    $message .= "{$item['name']} - {$item['quantity']} x Rs.{$item['price']}\n";
  }
  $message .= "\nTotal Amount: Rs.$total\n";
  $message .= "\nShipping Info:\nEmail: $email\nPhone: $phone\nAddress: $address, $city - $postal\n\nCarZilla Auto System";

  $headers = "From: noreply@carzilla.com";
  @mail($to, $subject, $message, $headers);

  unset($_SESSION['cart']);

  echo "<script>alert('✅ Your order has been placed successfully! Thank you, $user_name.'); window.location.href='index.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - CarZilla</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">CarZilla</a>
      <a href="cart.php" class="btn btn-outline-light btn-sm">Back to Cart</a>
    </div>
  </nav>

  <div class="container py-5">
    <h2 class="text-center fw-bold mb-4">🧾 Checkout Summary</h2>

    <div class="table-responsive mb-4">
      <table class="table table-striped table-bordered align-middle shadow-sm text-center">
        <thead class="table-dark">
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($_SESSION['cart'] as $item): 
            $item['quantity'] = $item['quantity'] ?? 1;
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
          <tr>
            <td class="fw-semibold"><?php echo htmlspecialchars($item['name']); ?></td>
            <td class="text-success fw-bold">Rs. <?php echo number_format($item['price'], 2); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td class="text-primary fw-bold">Rs. <?php echo number_format($subtotal, 2); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Checkout Form -->
    <div class="card shadow-lg mb-5">
      <div class="card-header bg-dark text-white fw-semibold">Shipping Information</div>
      <div class="card-body">
        <form method="POST" id="checkoutForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Address</label>
              <input type="text" name="address" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" name="city" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Postal Code</label>
              <input type="text" name="postal" class="form-control" required>
            </div>
          </div>

          <div class="text-end mt-4">
            <h4 class="fw-bold">Total Amount: 
              <span class="text-success">Rs. <?php echo number_format($total, 2); ?></span>
            </h4>
          </div>

          <div class="text-center mt-4">
            <button type="button" class="btn btn-primary px-4 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#confirmModal">
              Proceed to Confirm
            </button>
          </div>

          <!-- Modal Confirmation -->
          <div class="modal fade" id="confirmModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title">Confirm Your Order</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                  <p>Are you sure you want to place this order, <strong><?php echo htmlspecialchars($user_name); ?></strong>?</p>
                  <p class="text-success fw-bold">Total: Rs. <?php echo number_format($total, 2); ?></p>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="submit" name="confirm_order" class="btn btn-success px-4">Yes, Confirm</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
