<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title??"Titre par défaut" ?></title>
    <meta name="description" content="ceci est une super page">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../Style/dist/main.css">
    <script src="../../Style/dist/main.js"></script>
</head>
<body>

    <?php include "View/view/".$this->view.".view.php";?>

</body>
</html>