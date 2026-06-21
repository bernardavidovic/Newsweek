<?php
$dbc = mysqli_connect('localhost', 'root', '', 'newsweek');
mysqli_set_charset($dbc, "utf8");
$msg = '';
$registriran = false;

if (isset($_POST['register'])) {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $passRep = $_POST['passRep'];

    if ($pass != $passRep) {
        $msg = 'Lozinke nisu iste!';
    } else {
        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
            $sql2 = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
            $stmt2 = mysqli_stmt_init($dbc);
            mysqli_stmt_prepare($stmt2, $sql2);
            mysqli_stmt_bind_param($stmt2, 'ssss', $ime, $prezime, $username, $hashed_password);
            mysqli_stmt_execute($stmt2);
            $registriran = true;
        }
    }
}
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek - Registracija</title>
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

        <?php if ($registriran) { ?>
            <p class="text-center">Uspješno ste se registrirali. <a href="administracija.php">Prijavite se</a></p>
        <?php } else { ?>

            <h2 class="text-center mb-4">Registracija</h2>

            <form action="registracija.php" method="POST" class="mx-auto" style="max-width:500px;">

                <?php if ($msg != '') { ?>
                    <p class="text-danger text-center"><?php echo $msg; ?></p>
                <?php } ?>

                <div class="mb-3">
                    <label class="form-label">Ime</label>
                    <input type="text" name="ime" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prezime</label>
                    <input type="text" name="prezime" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Korisničko ime</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lozinka</label>
                    <input type="password" name="pass" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ponovite lozinku</label>
                    <input type="password" name="passRep" class="form-control">
                </div>

                <button type="submit" name="register" class="btn btn-primary w-100">Registriraj se</button>

            </form>

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
