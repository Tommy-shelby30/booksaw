<?php
session_start();
include('Admin/conn.php');

if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit();
}


if(isset($_POST['action'])){
  $action = $_POST['action'];
  $name = $_POST['name'];

  if($action === 'remove'){
    foreach($_SESSION['cart'] as $key => $item){
      if($item['name'] == $name){
        unset($_SESSION['cart'][$key]);
        break;
      }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    echo "removed";
    exit();
  }

  if($action === 'updateQty'){
    $qty = intval($_POST['qty']);
    foreach($_SESSION['cart'] as $key => $item){
      if($item['name'] == $name){
        $_SESSION['cart'][$key]['quantity'] = $qty;
        break;
      }
    }
    echo "updated";
    exit();
  }
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">CarZilla</a>
    <a href="index.php" class="btn btn-outline-light btn-sm">Continue Shopping</a>
  </div>
</nav>

<div class="container py-5 mb-5">
  <h2 class="mb-4 fw-bold text-center">🛒 Your Shopping Cart</h2>

  <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <!-- Desktop Table -->
    <div class="table-responsive d-none d-md-block">
      <table class="table align-middle table-striped table-bordered shadow-sm">
        <thead class="table-dark text-center">
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          <?php foreach($_SESSION['cart'] as &$item): 
            if(!isset($item['quantity'])) $item['quantity'] = 1;
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
            <tr data-name="<?php echo htmlspecialchars($item['name']); ?>">
              <td><img src="<?php echo $item['image']; ?>" class="img-fluid rounded" style="max-width: 100px;"></td>
              <td class="fw-semibold"><?php echo htmlspecialchars($item['name']); ?></td>
              <td class="text-success fw-bold price" data-price="<?php echo $item['price']; ?>">Rs. <?php echo number_format($item['price'], 2); ?></td>
              <td>
                <div class="input-group input-group-sm justify-content-center">
                  <button class="btn btn-outline-secondary minus-btn" type="button">−</button>
                  <input type="text" class="form-control text-center quantity" value="<?php echo $item['quantity']; ?>" readonly style="max-width:60px;">
                  <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                </div>
              </td>
              <td class="fw-bold text-primary subtotal">Rs. <?php echo number_format($subtotal, 2); ?></td>
              <td><button class="btn btn-sm btn-danger remove-btn">Remove</button></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Mobile Card View -->
    <div class="d-block d-md-none">
      <?php foreach($_SESSION['cart'] as &$item): 
        if(!isset($item['quantity'])) $item['quantity'] = 1;
        $subtotal = $item['price'] * $item['quantity'];
      ?>
      <div class="card mb-3 shadow-sm" data-name="<?php echo htmlspecialchars($item['name']); ?>">
        <div class="row g-0">
          <div class="col-4">
            <img src="<?php echo $item['image']; ?>" class="img-fluid rounded-start" alt="">
          </div>
          <div class="col-8">
            <div class="card-body">
              <h6 class="card-title fw-semibold"><?php echo htmlspecialchars($item['name']); ?></h6>
              <p class="card-text text-success fw-bold mb-1">Rs. <?php echo number_format($item['price'], 2); ?></p>
              <div class="input-group input-group-sm mb-2" style="max-width: 130px;">
                <button class="btn btn-outline-secondary minus-btn" type="button">−</button>
                <input type="text" class="form-control text-center quantity" value="<?php echo $item['quantity']; ?>" readonly>
                <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
              </div>
              <p class="card-text subtotal text-primary fw-bold mb-2">Subtotal: Rs. <?php echo number_format($subtotal, 2); ?></p>
              <button class="btn btn-sm btn-danger remove-btn">Remove</button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Desktop Total -->
    <div class="text-end mt-4 d-none d-md-block">
      <h4 class="fw-bold">Total: <span id="totalAmount" class="text-success">Rs. <?php echo number_format($total, 2); ?></span></h4>
      <form action="checkout.php" method="POST" class="d-inline">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <button type="submit" class="btn btn-primary mt-3 px-4">Proceed to Checkout</button>
      </form>
    </div>

    <!-- Floating Summary (Mobile Only) -->
    <div class="d-flex justify-content-between align-items-center bg-white border-top shadow-lg p-3 fixed-bottom d-md-none">
      <span class="fw-bold">Total: <span id="mobileTotal" class="text-success">Rs. <?php echo number_format($total, 2); ?></span></span>
      <form action="checkout.php" method="POST" class="mb-0">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
      </form>
    </div>

  <?php else: ?>
    <div class="text-center py-5">
      <h4 class="text-muted">Your cart is empty 😢</h4>
      <a href="index.php" class="btn btn-dark mt-3">Go Back to Shop</a>
    </div>
  <?php endif; ?>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){

  // Quantity change
  $(document).on('click', '.plus-btn, .minus-btn', function(){
    const cardOrRow = $(this).closest('[data-name]');
    const qtyInput = cardOrRow.find('.quantity');
    let qty = parseInt(qtyInput.val());
    const price = parseFloat(cardOrRow.find('.price').data('price') || cardOrRow.find('.card-text.text-success').text().replace('Rs.',''));
    const name = cardOrRow.data('name');

    if($(this).hasClass('plus-btn')) qty++;
    else if(qty > 1) qty--;

    qtyInput.val(qty);
    const subtotal = qty * price;
    cardOrRow.find('.subtotal').text('Subtotal: Rs. ' + subtotal.toFixed(2));

    updateTotal();
    $.post('cart.php', { action: 'updateQty', name: name, qty: qty });
  });

  // Remove item
  $(document).on('click', '.remove-btn', function(){
    const cardOrRow = $(this).closest('[data-name]');
    const name = cardOrRow.data('name');

    $.post('cart.php', { action: 'remove', name: name }, function(res){
      if(res.trim() === 'removed'){
        cardOrRow.fadeOut(300, function(){
          $(this).remove();
          updateTotal();

          if($('[data-name]').length === 0){
            $('.table-responsive, .d-block.d-md-none').html('<div class="text-center py-5"><h4 class="text-muted">Your cart is empty 😢</h4><a href="index.php" class="btn btn-dark mt-3">Go Back to Shop</a></div>');
            $('.fixed-bottom').addClass('d-none');
          }
        });
      }
    });
  });

  // Update total
  function updateTotal(){
    let total = 0;
    $('[data-name]').each(function(){
      const subtotalText = $(this).find('.subtotal').text().replace('Subtotal: Rs. ','').replace('Rs.','');
      total += parseFloat(subtotalText);
    });
    $('#totalAmount').text('Rs. ' + total.toFixed(2));
    $('#mobileTotal').text('Rs. ' + total.toFixed(2));

    if(total > 0) $('.fixed-bottom').removeClass('d-none');
    else $('.fixed-bottom').addClass('d-none');
  }

});
</script>

</body>
</html>
