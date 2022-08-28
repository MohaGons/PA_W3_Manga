<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Template du back</title>
        <meta name="description" content="ceci est une super page">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo LINK_CSS;?>">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://kit.fontawesome.com/8995af73d5.js" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    </head>

    <body>
        <header>
            <div class="logoAndName">
                <a href="#">
                    <img class="img-logo" src="/Style/images/Gambling-school.png">
                </a>
                <p>Manga-site</p>
            </div>

            <?php include "View/Template/sidebar.tpl.php";?>

        </header>

        <main>
            <?php include "View/Template/sidebar.tpl.php";?>

            <div class="container">
                <?php include "View/view/".$this->view.".view.php";?>
            </div>

        </main>
    </body>
</html>