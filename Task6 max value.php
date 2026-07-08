<?php
/* QUESTION: Given an array of numbers, find and return the largest number. */

function findMax($arr)
{
    $max = $arr[0];

    foreach ($arr as $num) {
        if ($num > $max) {
            $max = $num;
        }
    }

    return $max;
}

$result = null;
$numbersInput = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $numbersInput = $_POST['numbers'] ?? '';

    $parts = array_map('trim', explode(',', $numbersInput));

    $numbers = [];
    $valid = true;

    foreach ($parts as $part) {

        if ($part == '' || !is_numeric($part)) {
            $valid = false;
            break;
        }

        $numbers[] = (float)$part;
    }

    if (!$valid || empty($numbers)) {
        $result = "Error: Please enter valid numbers separated by commas.";
    } else {
        $result = findMax($numbers);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 6 - Max Value</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:600px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Find Maximum Number
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Enter Numbers
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="numbers"
                        placeholder="5, 4, 9, 3, 1, 7, 5, 8, 6"
                        value="<?= htmlspecialchars($numbersInput) ?>"
                        required>

                    <div class="form-text">
                        Separate numbers with commas (,)
                    </div>

                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Find Maximum
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (is_string($result)): ?>

                    <div class="alert alert-danger mt-4">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <div class="alert alert-success mt-4 text-center">

                        <h5 class="mb-3">
                            Maximum Number
                        </h5>

                        <span class="badge bg-success fs-3 p-3">
                            <?= htmlspecialchars($result) ?>
                        </span>

                    </div>

                <?php endif; ?>

            <?php endif; ?>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>