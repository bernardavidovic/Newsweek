<?php
$dbc = mysqli_connect('localhost', 'root', '', 'newsweek');
mysqli_set_charset($dbc, "utf8");

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $date = date('d.m.Y.');
    $archive = isset($_POST['archive']) ? 1 : 0;
    $picture = $_FILES['pphoto']['name'];
    move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/'.$picture);

    $sql = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $date, $title, $about, $content, $picture, $category, $archive);
    mysqli_stmt_execute($stmt);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek - Nova vijest</title>
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
            <li class="nav-item"><a class="nav-link active" href="administracija.php">Administracija</a></li>
        </ul>
    </div>
</nav>

<main class="content">
    <div class="container">
        <h2 class="text-center mb-4">Nova vijest</h2>

        <form action="unos.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width:600px;">

            <div class="mb-3">
                <label class="form-label">Naslov</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Kratki sadržaj</label>
                <textarea name="about" rows="2" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sadržaj</label>
                <textarea name="content" rows="8" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Slika</label>
                <input type="file" name="pphoto" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategorija</label>
                <select name="category" class="form-select">
                    <option value="priroda">Priroda</option>
                    <option value="povijest">Povijest</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="archive" class="form-check-input" id="archive">
                <label class="form-check-label" for="archive">Arhiviraj</label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Spremi</button>

        </form>
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
