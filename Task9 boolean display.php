<?php
/* QUESTION: Given a mixed array, display booleans as "Yes"/"No",
   and every other value as-is. */

function parseValue($v)
{
    $v = trim($v);

    if (strtolower($v) === "true") {
        return true;
    }

    if (strtolower($v) === "false") {
        return false;
    }

    if (is_numeric($v)) {
        return $v + 0;
    }

    return $v;
}

function displayMixed($arr)
{
    $result = [];

    foreach ($arr as $item) {

        if (is_bool($item)) {

            $result[] = $item ? "Yes" : "No";

        } else {

            $result[] = $item;

        }

    }

    return $result;
}

$result = null;
$itemsInput = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $itemsInput = $_POST['items'] ?? '';

    $parts = array_filter(
        array_map('trim', explode(',', $itemsInput)),
        fn($item) => $item !== ''
    );

    if (empty($parts)) {

        $result = "Error: Please enter at least one value.";

    } else {

        $values = array_map('parseValue', $parts);

        $result = displayMixed($values);

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 9 - Boolean Display</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:650px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Boolean Display
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Enter Values
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="items"
                        placeholder="1, tariq, 1.5, true, 7, s, false"
                        value="<?= htmlspecialchars($itemsInput) ?>"
                        required>

                    <div class="form-text">
                        Separate values with commas (,). Use <b>true</b> or <b>false</b> for boolean values.
                    </div>

                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Display
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (is_string($result)): ?>

                    <div class="alert alert-danger mt-4 text-center">
                        <?= htmlspecialchars($result) ?>
                    </div>

                <?php else: ?>

                    <div class="alert alert-success mt-4">

                        <h5 class="text-center mb-3">
                            Output
                        </h5>

                        <div class="d-flex flex-wrap justify-content-center gap-2">

                            <?php foreach ($result as $value): ?>

                                <span class="badge bg-success fs-6 p-3">
                                    <?= htmlspecialchars($value) ?>
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