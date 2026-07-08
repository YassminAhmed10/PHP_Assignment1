<?php
/* QUESTION: Check a user's age. If age > 18 -> approved to login,
   otherwise -> not approved. */

function checkAge($age)
{
    if ($age > 18) {
        return "Approved: You are allowed to register/login on the site.";
    } else {
        return "Not Approved: You are not allowed to register/login.";
    }
}

$result = null;
$age = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = $_POST['age'] ?? '';

    if ($age === '' || !is_numeric($age)) {
        $result = "Error: Please enter a valid age.";
    } else {
        $result = checkAge((int)$age);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1 - Age Check</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:500px;">
        <div class="card-body">

            <h2 class="text-center mb-4">Age Check</h2>

            <form method="POST">

                <div class="mb-3">
                    <label for="age" class="form-label">
                        Enter Your Age
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        id="age"
                        name="age"
                        placeholder="Enter your age"
                        value="<?= htmlspecialchars($age) ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Check
                </button>

            </form>

            <?php if ($result !== null): ?>

                <?php
                    if (str_starts_with($result, "Approved")) {
                        $class = "alert alert-success";
                    } else {
                        $class = "alert alert-danger";
                    }
                ?>

                <div class="<?= $class ?> mt-4">
                    <?= htmlspecialchars($result) ?>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>