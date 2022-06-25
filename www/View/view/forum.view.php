<h1>Forum</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col--flex">
       <div class="container">
            <div class="row">
                <h4><?= $forum_data[0]['title'] ?></h4>
            </div>

            <div class="row card--content">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Description</h2>
                    <p><?= html_entity_decode($forum_data[0]['description']) ?></p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-12 content">
                    <h2>Commentaire</h2>
                    <p>Apparitions dans les recherches internet</p>
                </div>
            </div>
        </div>
    </div>
</div>