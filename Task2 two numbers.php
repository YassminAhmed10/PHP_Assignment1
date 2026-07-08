<?php
/* QUESTION: Take 2 numbers, print their product, difference, and quotient. */

function calcTwoNumbers($a, $b)
{
    $product = $a * $b;
    $difference = $a - $b;

    if ($b != 0) {
        $quotient = $a / $b;
    } else {
        $quotient = "Undefined";
    }

    return [
        "Product" => $product,
        "Difference" => $difference,
        "Quotient" => $quotient
    ];
}

$result = null;
$a = '';
$b = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $a = $_POST['a'] ?? '';
    $b = $_POST['b'] ?? '';

    if (!is_numeric($a) || !is_numeric($b)) {
        $result = "Error: Please enter valid numbers.";
    } else {
        $result = calcTwoNumbers((float)$a, (float)$b);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2 - Two Numbers</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:700px;">
        <div class="card-body">

            <h2 class="text-center mb-4">Two Numbers Calculator</h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">First Number</label>
                    <input
                        type="number"
                        step="any"
                        class="form-control"
                        name="a"
                        placeholder="Enter First Number"
                        value="<?= htmlspecialchars($a) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Second Number</label>
                    <input
                        type="number"
                        step="any"
                        class="form-control"
                        name="b"
                        placeholder="Enter Second Number"
                        value="<?= htmlspecialchars($b) ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Calculate
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (is_string($result)): ?>

                    <div class="alert alert-danger mt-4">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <div class="row mt-4">

                        <?php foreach ($result as $title => $value): ?>

                            <div class="col-md-4 mb-3">

                                <div class="card text-center border-success shadow-sm">

                                    <div class="card-header bg-success text-white">
                                        <?= $title ?>
                                    </div>

                                    <div class="card-body">
                                        <h3 class="text-success">
                                            <?= htmlspecialchars($value) ?>
                                        </h3>
                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>