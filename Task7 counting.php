<?php
/* QUESTION: Given an array of movies, count how many times a specific
   movie title is repeated. */

function countMovie($films, $keyword)
{
    $count = 0;

    foreach ($films as $film) {

        if (strtolower($film) === strtolower($keyword)) {
            $count++;
        }

    }

    return $count;
}


$result = null;
$filmsInput = '';
$keyword = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $filmsInput = $_POST['films'] ?? '';
    $keyword = trim($_POST['keyword'] ?? '');

    $films = array_filter(array_map('trim', explode(',', $filmsInput)));


    if (empty($films) || $keyword == '') {

        $result = "Error: Please enter movies and a keyword.";

    } else {

        $result = countMovie($films, $keyword);

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task 7 - Counting Repeats</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


    <div class="card shadow mx-auto" style="max-width:600px;">


        <div class="card-body">


            <h2 class="text-center mb-4">
                Count Movie Repeats
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
                        placeholder="Avatar, Prestige, Avatar"
                        value="<?= htmlspecialchars($filmsInput) ?>"
                        required>


                    <div class="form-text">
                        Enter movies separated by commas (,)
                    </div>


                </div>




                <div class="mb-3">

                    <label class="form-label">
                        Movie To Count
                    </label>


                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Avatar"
                        value="<?= htmlspecialchars($keyword) ?>"
                        required>


                </div>




                <button type="submit" class="btn btn-primary w-100">
                    Count
                </button>


            </form>




            <?php if ($result !== null): ?>


                <?php if (is_string($result)): ?>


                    <div class="alert alert-danger mt-4 text-center">

                        <?= htmlspecialchars($result) ?>

                    </div>


                <?php else: ?>


                    <div class="alert alert-success mt-4 text-center">


                        <h5>
                            Count Result
                        </h5>


                        <span class="badge bg-success fs-3 p-3">

                            <?= htmlspecialchars($result) ?>

                        </span>


                        <p class="mt-3 mb-0">
                            Times found
                        </p>


                    </div>


                <?php endif; ?>


            <?php endif; ?>



        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>