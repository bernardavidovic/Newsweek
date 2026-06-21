<?php
session_start();
$dbc = mysqli_connect('localhost', 'root', '', 'newsweek');
mysqli_set_charset($dbc, "utf8");

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: administracija.php');
    exit;
}

if (isset($_POST['prijava'])) {
    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $razinaKorisnika);

    $uspjesnaPrijava = false;
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_fetch($stmt);
        if (password_verify($lozinka, $lozinkaKorisnika)) {
            $uspjesnaPrijava = true;
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['razina'] = $razinaKorisnika;
        }
    }
}

if (isset($_POST['delete']) && $_SESSION['razina'] == 1) {
    $id = $_POST['id'];
    $sql = "DELETE FROM vijesti WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST['update']) && $_SESSION['razina'] == 1) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
    $picture = $_POST['old_picture'];
    if ($_FILES['pphoto']['name'] != '') {
        $picture = $_FILES['pphoto']['name'];
        move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/'.$picture);
    }

    $sql = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssii', $title, $about, $content, $picture, $category, $archive, $id);
    mysqli_stmt_execute($stmt);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek - Administracija</title>
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

    <?php if (isset($_SESSION['username']) && $_SESSION['razina'] == 1) { ?>

        <p class="text-center">Prijavljeni ste kao <?php echo $_SESSION['username']; ?> - <a href="administracija.php?logout=1">Odjava</a></p>

        <h2 class="text-center mb-4">Nova vijest</h2>

        <form action="unos.php" method="POST" enctype="multipart/form-data" class="mx-auto mb-5" style="max-width:600px;">
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
                <textarea name="content" rows="6" class="form-control"></textarea>
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
            <button type="submit" name="submit" class="btn btn-primary">Spremi</button>
        </form>

        <h2 class="text-center mb-4">Uređivanje vijesti</h2>

        <?php
        $query = "SELECT * FROM vijesti";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="admin-entry">';
            echo '<form enctype="multipart/form-data" action="administracija.php" method="POST">';
            echo '<div class="mb-2"><label class="form-label">Naslov</label><input type="text" name="title" class="form-control" value="'.$row['naslov'].'"></div>';
            echo '<div class="mb-2"><label class="form-label">Kratki sadržaj</label><textarea name="about" class="form-control">'.$row['sazetak'].'</textarea></div>';
            echo '<div class="mb-2"><label class="form-label">Sadržaj</label><textarea name="content" class="form-control">'.$row['tekst'].'</textarea></div>';
            echo '<div class="mb-2"><label class="form-label">Slika</label><input type="file" name="pphoto" class="form-control"><img src="img/'.$row['slika'].'"></div>';
            echo '<div class="mb-2"><label class="form-label">Kategorija</label><select name="category" class="form-select">';
            echo '<option value="priroda"'.($row['kategorija']=='priroda'?' selected':'').'>Priroda</option>';
            echo '<option value="povijest"'.($row['kategorija']=='povijest'?' selected':'').'>Povijest</option>';
            echo '</select></div>';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo '<input type="hidden" name="old_picture" value="'.$row['slika'].'">';
            echo '<button type="submit" name="update" class="btn btn-primary">Spremi</button> ';
            echo '<button type="submit" name="delete" class="btn btn-danger">Izbriši</button>';
            echo '</form></div>';
        }
        mysqli_close($dbc);
        ?>

    <?php } elseif (isset($_SESSION['username'])) { ?>

        <p class="text-center">Bok <?php echo $_SESSION['username']; ?>, nemate prava pristupa. <a href="administracija.php?logout=1">Odjava</a></p>

    <?php } else { ?>

        <h2 class="text-center mb-4">Prijava</h2>

        <?php if (isset($_POST['prijava']) && !$uspjesnaPrijava) { ?>
            <p class="text-danger text-center">Pogrešno korisničko ime ili lozinka. <a href="registracija.php">Registrirajte se</a></p>
        <?php } ?>

        <form action="administracija.php" method="POST" class="mx-auto" style="max-width:500px;">
            <div class="mb-3">
                <label class="form-label">Korisničko ime</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Lozinka</label>
                <input type="password" name="lozinka" class="form-control">
            </div>
            <button type="submit" name="prijava" class="btn btn-primary w-100">Prijavi se</button>
        </form>

        <p class="text-center mt-3"><a href="registracija.php">Registrirajte se</a></p>

    <?php } ?>

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
