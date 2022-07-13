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
                <a href="event/create"><button class="control--add">Ajouter</button></a>
                </th>
            </thead>
            <tbody>
                <?php
                foreach ($event_data as $key => $value) { ?>
                    <tr>
                        <td><?= $value["name"] ?></td>
                        <td>
                            <?php
                            if (strlen($value["description"]) >= 60) {
                                echo html_entity_decode(substr($value["description"], 0, 60) . "...");
                            } else {
                                echo html_entity_decode($value["description"]);
                            }
                             ?>
                        </td>
                        <td><?= $value["price"] ?>€</td>
                        <td><?= $value["date"] ?></td>
                        <td><?= $value["photo"] ?></td>
                        <td>
                            <a href="event/edit/<?= $value['id']?>">Update</a>
                            <a href="event/delete/<?= $value['id']?>"><button class="control--delete">Supprimer</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>