<?php
/* QUESTION: RouteBubble - sort any array passed to it using Bubble Sort. */

function RouteBubble($arr)
{
    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {

        for ($j = 0; $j < $n - $i - 1; $j++) {

            if ($arr[$j] > $arr[$j + 1]) {

                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;

            }

        }

    }

    return $arr;
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

        $result = RouteBubble($numbers);

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 5 - Bubble Sort</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:650px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Bubble Sort
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
                        placeholder="6, 4, 9, 3, 12, 8, 7"
                        value="<?= htmlspecialchars($numbersInput) ?>"
                        required>

                    <div class="form-text">
                        Separate numbers with commas (,)
                    </div>

                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Sort
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (is_string($result)): ?>

                    <div class="alert alert-danger mt-4">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <div class="alert alert-success mt-4">

                        <h5 class="text-center mb-3">
                            Sorted Array
                        </h5>

                        <div class="d-flex flex-wrap justify-content-center gap-2">

                            <?php foreach ($result as $number): ?>

                                <span class="badge bg-success fs-6 p-3">
                                    <?= htmlspecialchars($number) ?>
                                </span>

                            <?php endforeach; ?>

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