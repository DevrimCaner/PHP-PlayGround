<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Student Track System</title>
        <!-- Bootstrap icons-->
        <link href="./css/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="./css/styles.css" rel="stylesheet" />
        <!-- Theme Overrite CSS-->
        <link href="./css/theme.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100 bg-light">
        <main class="flex-shrink-0">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Öğrenci Takip Sistemi</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if($PageName == 'students'){echo 'active'; }?>" aria-current="page" href="index.php?page=students">Öğrenciler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($PageName == 'courses'){echo 'active'; }?>" href="index.php?page=courses">Dersler</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>