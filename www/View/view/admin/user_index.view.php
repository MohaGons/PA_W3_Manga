
<h1><i class="fa-solid fa-user"></i>Utilisateurs</h1>
<h2>Nombre d'utilisateurs :  <?= $Nbusers ?></h2>

<!--<div style="display: flex; justify-content: space-between">-->
<!--    <div>-->
<!--        <label>Trier par date </label><a href="?action=date"><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></a>-->
<!--        <label>Trier par Nom </label><a href="?action=nom"><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></a>-->
<!--    </div>-->
<!--    <div>-->
<!--        <form>-->
<!--            <div>-->
<!---->
<!--                <input type="search" name="user" class="searchinput" placeholder="Rechercher un utilisateur…">-->
<!--                <button><i class="fa fa-search" aria-hidden="true"></i></button>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->
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

                    <td><a href="?action=delete&id=<?= $user['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                    <td><a href="utilisateurs/edit/<?= $user['id'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                    <td><a href="?action=contact&id=<?= $user['id'] ?>"><i class="fa-solid fa-paper-plane"></i></a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>

    </table>


<script type="text/javascript" src="../Style/src/js/admin/user_idex.js"></script>


