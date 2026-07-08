<?php
/* QUESTION: Given two arrays, find all values that appear in both. */

function findCommon($arr1, $arr2)
{
    return array_values(array_intersect($arr1, $arr2));
}

$result = null;
$arr1Input = '';
$arr2Input = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $arr1Input = $_POST['arr1'] ?? '';
    $arr2Input = $_POST['arr2'] ?? '';

    $arr1 = array_filter(array_map('trim', explode(',', $arr1Input)), fn($v) => $v !== '');
    $arr2 = array_filter(array_map('trim', explode(',', $arr2Input)), fn($v) => $v !== '');

    if (empty($arr1) || empty($arr2)) {

        $result = "Error: Please enter values for both lists.";

    } else {

        $common = findCommon($arr1, $arr2);

        if (empty($common)) {
            $result = "No common values found.";
        } else {
            $result = $common;
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 11 - Common Values</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Common Values
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        First List
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="arr1"
                        placeholder="a, b, c, d"
                        value="<?= htmlspecialchars($arr1Input) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Second List
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="arr2"
                        placeholder="c, d, e, f"
                        value="<?= htmlspecialchars($arr2Input) ?>"
                        required>

                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Find Common Values
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (is_string($result)): ?>

                    <?php
                    $class = str_starts_with($result, "Error") || $result == "No common values found."
                        ? "alert-danger"
                        : "alert-success";
                    ?>

                    <div class="alert <?= $class ?> mt-4 text-center">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <div class="card border-success shadow-sm mt-4">

                        <div class="card-header bg-success text-white text-center">
                            Common Values
                        </div>

                        <div class="card-body">

                            <div class="d-flex flex-wrap justify-content-center gap-2">

                                <?php foreach ($result as $value): ?>

                                    <div class="bg-success text-white rounded px-3 py-2 fw-bold">
                                        <?= htmlspecialchars($value) ?>
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