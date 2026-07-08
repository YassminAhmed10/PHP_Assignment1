<?php
/* QUESTION: Given a unit price and quantity, calculate total price
   and apply discount: >1000 -> 15%, else -> 10%. */

function calculateInvoice($price, $quantity)
{
    if (!is_numeric($price) || !is_numeric($quantity)) {
        return "Error: please enter numbers only.";
    }
    $price = (float)$price;
    $quantity = (float)$quantity;
    if ($price < 0 || $quantity < 0) {
        return "Error: negative numbers are not allowed.";
    }


    $total = $price * $quantity;
    $discountRate = ($total > 1000) ? 0.15 : 0.10;
    $discountValue = $total * $discountRate;
    $finalPrice = $total - $discountValue;


    return [
        "Total Before Discount" => $total,
        "Discount Rate" => ($discountRate * 100) . "%",
        "Discount Value" => $discountValue,
        "Final Price" => $finalPrice
    ];
}


$result = null;
$price = '';
$quantity = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $result = calculateInvoice($price, $quantity);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task 12-Invoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">


<div class="container mt-5">


<div class="card shadow mx-auto" style="max-width:700px;">


<div class="card-body">


<h2 class="text-center mb-4">
    E-commerce Invoice
</h2>



<form method="POST">


<div class="mb-6">

<label class="form-label">
    Unit Price
</label>

<input
type="number"
step="any"
class="form-control"
name="price"
placeholder="150"
value="<?= htmlspecialchars($price) ?>"
required>

</div>



<div class="mb-3">

<label class="form-label">
    Quantity
</label>

<input
type="number"
step="any"
class="form-control"
name="quantity"
placeholder="5"
value="<?= htmlspecialchars($quantity) ?>"
required>

</div>



<button class="btn btn-primary w-100">
    Calculate
</button>



</form>




<?php if ($result !== null): ?>


<?php if (is_string($result)): ?>


<div class="alert alert-danger mt-4 text-center">

<?= htmlspecialchars($result) ?>

</div>



<?php else: ?>


<div class="mt-4">



<div class="card border-secondary mb-3">

<div class="card-header bg-secondary text-white text-center">
    Total Before Discount
</div>


<div class="card-body text-center fs-4">

<?= htmlspecialchars($result["Total Before Discount"]) ?>

</div>


</div>




<!-- Discount -->

<div class="card border-warning mb-3">
<div class="card-header bg-warning text-dark text-center">
Discount

</div>
<div class="card-body text-center">


<p class="mb-1">

Rate:

<strong>
<?= htmlspecialchars($result["Discount Rate"]) ?>
</strong>

</p>



<p class="mb-1">

Value:

<strong>
<?= htmlspecialchars($result["Discount Value"]) ?>
</strong>

</p>


</div>


</div>

<div class="card border-success">
<div class="card-header bg-success text-white text-center">

Final Price

</div>



<div class="card-body text-center text-success fw-bold fs-2">

<?= htmlspecialchars($result["Final Price"]) ?>

</div>


</div>



</div>



<?php endif; ?>



<?php endif; ?>



</div>


</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>