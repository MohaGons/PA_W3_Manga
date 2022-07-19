<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Template du front</title>
    <meta name="description" content="ceci est une super page">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo LINK_CSS;?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/8995af73d5.js" crossorigin="anonymous"></script>
</head>

<body>
<main>
    <?php include "View/view/" . $this->view . ".view.php"; ?>
</main>

<script src="../../Style/dist/main.js"></script>

</body>

</html>