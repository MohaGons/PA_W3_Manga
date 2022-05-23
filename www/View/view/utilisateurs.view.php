<h1><i class="fa-solid fa-user"></i> Nombre d'utilisateurs : <?= $Nbusers ?></h1>
<hr><hr><br><br>
<?php if (!empty($messages)) {
    foreach ($messages as $message) {
        echo "<h2 style='color:red'>".$message. "</h2><br>";
    }
}?>
<table style="width:60%;" >
    <tr>
        <th>Gender</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
    </tr>
    <?php
    foreach($users as $user){
        ?>
        <tr style="text-align: center">
            <td><?= $user['gender'] ?></td>
            <td ><?= $user['lastname'] ?></td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><a href="?action=delete&id=<?= $user['ID'] ?>"><i class="fa-solid fa-trash"></i></a></td>
            <td><a href="utilisateurs/update?action=update&id=<?= $user['ID'] ?>"><i class="fa-solid fa-pen"></i></a></td>
            <td><a href="?action=contact&id=<?= $user['ID'] ?>"><i class="fa-solid fa-paper-plane"></i></a></td>
        </tr>
        <?php
    }
    ?>
</table><hr>

