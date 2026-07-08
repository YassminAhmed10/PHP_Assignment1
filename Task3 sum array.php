<?php
/* QUESTION: Take an array of numbers, return the sum. */

function sumArray($arr)
{
    $total = 0;

    foreach ($arr as $num) {
        $total += $num;
    }

    return $total;
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
        $result = "Error: Please enter numbers separated by commas.";
    } else {
        $result = "Sum = " . sumArray($numbers);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3 - Sum Array</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:600px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Sum of Array
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
                        placeholder="Example: 1, 2, 3, 4, 5"
                        value="<?= htmlspecialchars($numbersInput) ?>"
                        required>

                    <div class="form-text">
                        Separate numbers using commas (,)
                    </div>

                </div>

                <button class="btn btn-primary w-100" type="submit">
                    Calculate Sum
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php
                    if (str_starts_with($result, "Error")) {
                        $class = "alert-danger";
                    } else {
                        $class = "alert-success";
                    }
                ?>

                <div class="alert <?= $class ?> mt-4 text-center">
                    <h4><?= htmlspecialchars($result) ?></h4>
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>