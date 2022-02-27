<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Template du back</title>
        <meta name="description" content="ceci est une super page">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../Style/dist/main.css">
        <script src="../../Style/dist/main.js"></script>
    </head>

    <body>
        <header>
            <div class="logoAndName">
                <a href="#">
                    <img class="img-logo" src="../../Style/images/Gambling-school.png">
                </a>
                <p>Manga-site</p>
            </div>

            <div class="photoAndMenu">
                <button id="menu-button">    </button>
                <img class="img-logo" src="../../Style/images/unsplash_K5TfhhrNs20.png">
            </div>
            <?php include "View/Template/sidebar.tpl.php";?>

        </header>

        <main>
            <?php include "View/Template/sidebar.tpl.php";?>

            <?php include "View/view/".$this->view.".view.php";?>
        </main>



    </body>
</html>