<h1>Catégories</h1>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col--flex">
        <div class="modal-header">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>modifier un évènement</h2>
            </div>
            <div class="modal-body">
                <?php $this->includePartial("form", $event->getEventEditFormRegister($event_data)); ?>
            </div>
        </div>
    </div>