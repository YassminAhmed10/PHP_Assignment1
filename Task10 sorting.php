<?php
/* QUESTION: Given an array of numbers, sort it once ascending and
   once descending. */

$result = null;
$numbersInput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $numbersInput = $_POST['numbers'] ?? '';

    $parts = array_map('trim', explode(',', $numbersInput));

    $numbers = [];
    $valid = true;

    foreach ($parts as $p) {

        if ($p === '' || !is_numeric($p)) {
            $valid = false;
            break;
        }

        $numbers[] = (float)$p;
    }

    if (!$valid || empty($numbers)) {

        $result = "Error: Please enter numbers separated by commas.";

    } else {

        $ascending = $numbers;
        sort($ascending);

        $descending = $numbers;
        rsort($descending);

        $result = [
            "Ascending" => $ascending,
            "Descending" => $descending
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 10 - Sorting</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Sorting Numbers
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

                    <div class="alert alert-danger mt-4 text-center">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <!-- Ascending -->
                    <div class="card border-success shadow-sm mt-4">

                        <div class="card-header bg-success text-white text-center">
                            Ascending
                        </div>

                        <div class="card-body">

                            <div class="d-flex flex-wrap justify-content-center gap-2">

                                <?php foreach ($result["Ascending"] as $num): ?>

                                    <div class="bg-success text-white rounded px-3 py-2 fw-bold">
                                        <?= htmlspecialchars($num) ?>
                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>

                    <!-- Descending -->
                    <div class="card border-primary shadow-sm mt-4">

                        <div class="card-header bg-primary text-white text-center">
                            Descending
                        </div>

                        <div class="card-body">

                            <div class="d-flex flex-wrap justify-content-center gap-2">

                                <?php foreach ($result["Descending"] as $num): ?>

                                    <div class="bg-primary text-white rounded px-3 py-2 fw-bold">
                                        <?= htmlspecialchars($num) ?>
                                    </div>

                                <?php endforeach; ?>

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