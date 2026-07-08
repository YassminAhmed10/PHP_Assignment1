<?php
/* QUESTION: RouteRandomPass - takes a number (length) and returns a
   random string with that many characters. */

function RouteRandomPass($length)
{
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charactersLength = strlen($characters);

    $randomString = "";

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

$result = null;
$length = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $length = $_POST['length'] ?? '';

    if ($length == '' || !is_numeric($length) || (int)$length <= 0) {

        $result = "Error: Please enter a positive number.";

    } else {

        $result = RouteRandomPass((int)$length);

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 8 - Random Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:600px;">

        <div class="card-body">

            <h2 class="text-center mb-4">
                Random Password Generator
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Password Length
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        name="length"
                        min="1"
                        placeholder="Enter password length"
                        value="<?= htmlspecialchars($length) ?>"
                        required>

                    <div class="form-text">
                        Example: 8, 10, 12, 16
                    </div>

                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Generate Password
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php if (str_starts_with($result, "Error")): ?>

                    <div class="alert alert-danger mt-4 text-center">

                        <?= htmlspecialchars($result) ?>

                    </div>

                <?php else: ?>

                    <div class="alert alert-success mt-4 text-center">

                        <h5 class="mb-3">
                            Generated Password
                        </h5>

                        <span class="badge bg-success fs-5 p-3">
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