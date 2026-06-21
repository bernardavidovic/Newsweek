<?php
$dbc = mysqli_connect('localhost', 'root', '', 'newsweek');
mysqli_set_charset($dbc, "utf8");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek - Naslovnica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>21.6.2026.</div>
        <div class="logo"><span>News</span>week</div>
        <div style="visibility:hidden;">21.6.2026.</div>
    </div>
</header>

<nav class="main-nav navbar navbar-expand-lg">
    <div class="container justify-content-center">
        <ul class="navbar-nav text-center">
            <li class="nav-item"><a class="nav-link active" href="index.php">Početna</a></li>
            <li class="nav-item"><a class="nav-link" href="kategorija.php?id=priroda">Priroda</a></li>
            <li class="nav-item"><a class="nav-link" href="kategorija.php?id=povijest">Povijest</a></li>
            <li class="nav-item"><a class="nav-link" href="administracija.php">Administracija</a></li>
        </ul>
    </div>
</nav>

<main class="content">
    <div class="container">

        <section class="category-block">
            <h2>Priroda</h2>
            <div class="row g-4">
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='priroda' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="col-12 col-md-4">';
                    echo '<div class="card">';
                    echo '<a href="clanak.php?id='.$row['id'].'"><img src="img/'.$row['slika'].'" class="card-img-top"></a>';
                    echo '<div class="card-body px-0"><h3 class="h5"><a href="clanak.php?id='.$row['id'].'">'.$row['naslov'].'</a></h3></div>';
                    echo '</div></div>';
                }
                ?>
            </div>
        </section>

        <section class="category-block">
            <h2>Povijest</h2>
            <div class="row g-4">
                <?php
                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='povijest' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="col-12 col-md-4">';
                    echo '<div class="card">';
                    echo '<a href="clanak.php?id='.$row['id'].'"><img src="img/'.$row['slika'].'" class="card-img-top"></a>';
                    echo '<div class="card-body px-0"><h3 class="h5"><a href="clanak.php?id='.$row['id'].'">'.$row['naslov'].'</a></h3></div>';
                    echo '</div></div>';
                }
                mysqli_close($dbc);
                ?>
            </div>
        </section>

    </div>
</main>

<footer class="site-footer">
    <div class="container">
        <p>Bernarda Vidović</p>
        <p>&copy; 2026 NEWSWEEK</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
