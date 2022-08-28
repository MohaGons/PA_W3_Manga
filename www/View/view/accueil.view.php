
<div class="row">
    <div class="col-xl-12">
        <div class="slider">
            <div class="slider-item active fade" data-target='1'>
                <img src="https://images.unsplash.com/photo-1552560220-076c2cda7b21?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=70" alt="slider image">
            </div>
            <div class="slider-item fade" data-target='2'>
                <img src="https://images.unsplash.com/photo-1622557850710-d08a111d3476?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=70" alt="slider image 2">
            </div>
            <div class="slider-item fade" data-target='3'>
                <img src="https://images.unsplash.com/photo-1622602724874-a279acda57a2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=70" alt="slider image 3">
            </div>
            <div class='slider-count'>1/3</div>
            <div class="slider-control">
                <button class="btn btn-slider-left"> <i class="fa-solid fa-arrow-left"></i> </button>
                <button class="btn btn-slider-right"> <i class="fa-solid fa-arrow-right"></i> </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="articles">
            <div class="row">
                <?php
                foreach ($recent_event as $key => $value) { ?>
                <div class="col-xl-4 col--flex flexArticle">
                    <img class="imgArticle" src="/Style/images/Evenements/<?= $recent_event[0]['photo'] ?>">
                    <p><?= $recent_event[0]['name'] ?></p>
                    <p>
                    <?php
                    if (strlen($recent_event[0]["description"]) >= 80) {
                        echo html_entity_decode(substr($recent_event[0]["description"], 0, 80) . "...");
                    } else {
                        echo html_entity_decode($recent_event[0]["description"]);
                    }
                    ?>
                    </p>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="../../Style/dist/main.js"></script>