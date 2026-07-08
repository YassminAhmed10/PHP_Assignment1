<?php
/* QUESTION: Search for a keyword inside an array of movie names.
   Return "yes" if found, "no" if not. */

function searchMovie($films, $keyword)
{
    foreach ($films as $film) {

        if (strtolower($film) === strtolower($keyword)) {
            return "yes";
        }
    }

    return "no";
}

$result = null;
$filmsInput = '';
$keyword = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $filmsInput = $_POST['films'] ?? '';
    $keyword = trim($_POST['keyword'] ?? '');

    $films = array_filter(array_map('trim', explode(',', $filmsInput)));

    if (empty($films) || $keyword === '') {

        $result = "Error: Please enter movies and a keyword.";

    } else {

        $result = "Found '$keyword'? " . searchMovie($films, $keyword);

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 4 - Search Movie</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


    <div class="card shadow mx-auto" style="max-width:600px;">


        <div class="card-body">


            <h2 class="text-center mb-4">
                Search Movie
            </h2>


            <form method="POST">


                <div class="mb-3">

                    <label class="form-label">
                        Movie List
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="films"
                        placeholder="Fast, Avatar, Prestige"
                        value="<?= htmlspecialchars($filmsInput) ?>"
                        required>

                    <div class="form-text">
                        Enter movies separated by commas (,)
                    </div>

                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Search For
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Enter movie name"
                        value="<?= htmlspecialchars($keyword) ?>"
                        required>

                </div>



                <button type="submit" class="btn btn-primary w-100">
                    Search
                </button>


            </form>



            <?php if ($result !== null): ?>


                <?php

                if (str_contains($result, "yes")) {
                    $class = "alert-success";
                } else {
                    $class = "alert-danger";
                }

                ?>


                <div class="alert <?= $class ?> mt-4 text-center">

                    <h5>
                        <?= htmlspecialchars($result) ?>
                    </h5>

                </div>


            <?php endif; ?>


        </div>


    </div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>