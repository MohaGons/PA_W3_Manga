<h1>Les events </h1>


<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <table class="table-latitude">
            <thead>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Photo</th>
                <th>Contrôles
                    <button class="control--add" id="add-button">Ajouter</button>
                </th>
            </thead>
            <tbody>
                <?php
                foreach ($event_data as $key => $value) { ?>
                    <tr>
                        <td><?= $value["name"] ?></td>
                        <td><?= $value["description"] ?></td>
                        <td><?= $value["price"] ?></td>
                        <td><?= $value["date"] ?></td>
                        <td><?= $value["photo"] ?></td>
                        <td>
                            <button class="control--modify" id="modify-button<?= $value['id'] ?>">Modifier</button>
                            <button class="control--delete" id="delete-button<?= $value['id'] ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ajout d'un event -->
<div class="modal" id="modal-add">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Ajouter un évènement</h2>
        </div>
        <div class="modal-body">
            <?php $this->includePartial("form", $event->getEventFormRegister()); ?>
        </div>
    </div>
</div>

<!-- suppréssion d'un event -->
<?php
foreach ($event as $key => $value) { ?>

    <span class="close">&times;</span>
    <h2>Supprimer un évènement</h2>
    </div>
    <a href="deletEvent?id=<?= $event_id ?>">Supprimer </a>
    </div>
    </div>
<?php
}
?>
<script src="../../Style/dist/deleteEvent.js"></script>

<?php //$this->includePartial("captcha", null);
?>



<?php //$this->includePartial("form", $user->getLoginForm());
?>