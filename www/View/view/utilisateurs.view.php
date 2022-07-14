<style>
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
    }

    .pagination a.active {
        background-color: black;
        color: white;
        border: 1px solid #4CAF50;
    }
    .searchinput{
        width: 80%;
        padding: 7px 7px;
        margin: 8px 0;
        box-sizing: border-box;
    }


    .progressbar-wrapper {
        background-color: #dfe6e9;
        color: white;
        border-radius: 15px;
        width: 100%;
    }

    .progressbar {
        background-color: black;
        color: white;
        padding: 0.3rem;
        text-align: right;
        font-size: 20px;
        border-radius: 15px;
    }


</style>
<div class="container">
<h1><i class="fa-solid fa-user"></i> Nombre d'utilisateurs : <?= $Nbusers ?></h1>
<div style="display: flex; justify-content: space-between">
<div>
    <label>Trier par date </label><a href="?action=date"><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></a>
    <label>Trier par Nom </label><a href="?action=nom"><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></a>
</div>
<div>
    <form>
        <div>

            <input type="search" name="user" class="searchinput" placeholder="Rechercher un utilisateur…">
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>
</div>
</div>
<hr><br>
<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:red'>".$message. "</h2><br>";
    }
}?>

<table style="width:100%;" >
    <tr style="background-color: black;height: 50px ; color:white;">
        <th>Gender</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Role</th>
        <th>Date Inscription</th>
        <th>Adresse</th>
    </tr>
    <?php
    foreach($users as $user){
        ?>
        <tr style="text-align: center; height:30px;background-color: #dfe6e9">
            <td><?= $user['gender'] ?></td>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['createdAt'] ?></td>
            <td> <?= $user['ville']?>, <?= $user['pays']?></td>
            <td><a href="?action=delete&id=<?= $user['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
            <td><a href="utilisateurs/update?action=update&id=<?= $user['id'] ?>"><i class="fa-solid fa-pen"></i></a></td>
            <td><a href="?action=contact&id=<?= $user['id'] ?>"><i class="fa-solid fa-paper-plane"></i></a></td>
        </tr>
        <?php
    }
    ?>
</table><hr>


    <div class="pagination">
        <?php
        if (isset($_GET['page'])){
            $active=$_GET['page'];
        }
        for($page = 1; $page <= $Nbpages; $page++): ?>
                <a href="?page=<?= $page ?>" <?php if (isset($active) && $page==$active){?> class="active" <?php }?>><?= $page ?></a>
        <?php endfor ?>
    </div>
</div>

<br><br>
    <div class="container">
        <h1>Les 5 pays les plus presenté</h1>
    <?php
    foreach($bestpays as $pays){
        ?>
        <p><?= $pays['pays'] ?> - <?= $pays['COUNT(*)'] ?></p>
        <div class="progressbar-wrapper">
            <div style="width: <?=($pays['COUNT(*)']/$Nbusers)*100?>%" class="progressbar"><?=round(($pays['COUNT(*)']/$Nbusers)*100) ?>%</div>
        </div>
        <?php
    }
    ?>
    </div>







