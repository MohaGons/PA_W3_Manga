<h1>Forum</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
        <table class="table-latitude">
            <thead>
                <th class="col-xl-4">Titre</th>
                <th class="col-xl-6">Description</th>
                <th class="col-xl-2">Contrôles
                <a href="forum/create"><button class="control--add">Ajouter</button></a>
                </th>
            </thead>
            <tbody>
                <?php 
                    foreach ($forums_data as $key => $value){ ?>
                        <tr>
                            <td><?php
                            if (strlen($value["title"]) >= 40) {
                                echo substr($value["title"], 0, 40) . "...";
                            } else {
                                echo $value["title"];
                            }
                            ?></td>
                            <td><?php
                            if (strlen($value["description"]) >= 60) {
                                echo html_entity_decode(substr($value["description"], 0, 60) . "...");
                            } else {
                                echo html_entity_decode($value["description"]);
                            }
                             ?></td>
                            <td>
                                <a href="forum/edit/<?= $value['id']?>">Update</a>
                                <a href="forum/delete/<?= $value['id']?>"><button class="control--delete">Supprimer</button></a>
                            </td>
                        </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    ClassicEditor
    .create( document.querySelector( '#descriptionForum' ) )
    .catch( error => {
        console.error( error );
    } );
</script>