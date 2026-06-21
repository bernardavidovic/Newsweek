<?php
$dbc = mysqli_connect('localhost', 'root', '', 'newsweek');
mysqli_set_charset($dbc, "utf8");
$id = $_GET['id'];
$sql = "SELECT * FROM vijesti WHERE id = ?";
$stmt = mysqli_stmt_init($dbc);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek - <?php echo $row['naslov']; ?></title>
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
            <li class="nav-item"><a class="nav-link" href="index.php">Početna</a></li>
            <li class="nav-item"><a class="nav-link" href="kategorija.php?id=priroda">Priroda</a></li>
            <li class="nav-item"><a class="nav-link" href="kategorija.php?id=povijest">Povijest</a></li>
            <li class="nav-item"><a class="nav-link" href="administracija.php">Administracija</a></li>
        </ul>
    </div>
</nav>

<main class="content">
    <div class="container">
        <section class="article-main">
            <span class="category-tag"><?php echo $row['kategorija']; ?></span>
            <h1><?php echo $row['naslov']; ?></h1>
            <div class="meta">
                <span>Autor: Bernarda Vidović</span>
                <span>Objavljeno: <?php echo $row['datum']; ?></span>
            </div>
            <div class="main-image">
                <img src="img/<?php echo $row['slika']; ?>">
            </div>
            <section class="sadrzaj">
                <p><?php echo $row['sazetak']; ?></p>
                <p><?php echo nl2br($row['tekst']); ?></p>
            </section>
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
