<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template du front</title>
    <meta name="description" content="ceci est une super page">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../Style/dist/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/8995af73d5.js" crossorigin="anonymous"></script>
</head>

<body>
<header id="headerFront" class="header--front">

    <div class="container">
        <div class="logoAndName logoAndName--front">
            <a href="#">
                <img class="img-logo" src="../../Style/images/Gambling-school.png">
            </a>
            <p>Manga-site</p>
        </div>
        <div class="photoAndMenu">
            <button id="menu-button">    </button>
            <?php include "View/Template/sidebar_front.tpl.php";?>
        </div>
    </div>
</header>

<main id="mainFront">
    <div class="container">
        <?php include "View/view/".$this->view.".view.php";?>
    </div>
</main>

<script src="../../Style/dist/main.js"></script>

</body>
</html>