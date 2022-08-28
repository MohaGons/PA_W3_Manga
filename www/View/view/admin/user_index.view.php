<style>
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
<h1><i class="fa-solid fa-user"></i>Utilisateurs</h1>
<h2>Nombre d'utilisateurs :  <?= $Nbusers ?></h2>

<hr><br>
<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:red'>".$message. "</h2><br>";
    }
}?>

    <table id="users_table" style="width: 100%">
        <thead>
            <tr>
                <th>Gender</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date Inscription</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($users as $user){
                ?>
                <tr style="text-align: center; height:30px;background-color: lightgrey">
                    <td><?= $user['gender'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['createdAt'] ?></td>

                    <td><a href="utilisateurs/delete/<?= $user['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                    <td><a href="utilisateurs/edit/<?= $user['id'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>

    </table>
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


