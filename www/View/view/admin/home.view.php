<h1>Dashboard</h1>

<div class="app-container">
  <div class="app-header">
    <div class="app-header-left">
      <div class="search-wrapper">
        <input class="search-input" type="text" placeholder="Rechercher">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search" viewBox="0 0 24 24">
          <defs></defs>
          <circle cx="11" cy="11" r="8"></circle>
          <path d="M21 21l-4.35-4.35"></path>
        </svg>
      </div>
    </div>
    <div class="app-header-right">
      <button class="mode-switch" title="Switch Theme">
        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <button class="add-btn" title="Add New Project">
        <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
          <line x1="12" y1="5" x2="12" y2="19" />
          <line x1="5" y1="12" x2="19" y2="12" /></svg>
      </button>
      <button class="notification-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
          <path d="M13.73 21a2 2 0 0 1-3.46 0" /></svg>
      </button>
    </div>
    <button class="messages-btn">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" /></svg>
    </button>
  </div>
  <div class="app-content">
    <div class="projects-section">
      <div class="projects-section-header">
        <p>Projet</p>
        <p class="time"><?= date('F j, Y',strtotime(date('Y-m-d'))) ?></p>
      </div>
      <div class="projects-section-line">
        <div class="projects-status">
          <div class="item-status">
            <span class="status-number">45</span>
            <span class="status-type">Pages</span>
          </div>
          <div class="item-status">
            <span class="status-number"><?= count($users)?></span>
            <span class="status-type">Utilisateurs</span>
          </div>
          <div class="item-status">
            <span class="status-number"><?= count($event_data)?></span>
            <span class="status-type">Évènements</span>
          </div>
          <div class="item-status">
            <span class="status-number"><?= count($forums_data)?></span>
            <span class="status-type">Forums</span>
          </div>
        </div>
        <div class="view-actions">
          <button class="view-btn list-view" title="List View">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
              <line x1="8" y1="6" x2="21" y2="6" />
              <line x1="8" y1="12" x2="21" y2="12" />
              <line x1="8" y1="18" x2="21" y2="18" />
              <line x1="3" y1="6" x2="3.01" y2="6" />
              <line x1="3" y1="12" x2="3.01" y2="12" />
              <line x1="3" y1="18" x2="3.01" y2="18" /></svg>
          </button>
          <button class="view-btn grid-view active" title="Grid View">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
              <rect x="3" y="3" width="7" height="7" />
              <rect x="14" y="3" width="7" height="7" />
              <rect x="14" y="14" width="7" height="7" />
              <rect x="3" y="14" width="7" height="7" /></svg>
          </button>
        </div>
      </div>
      
      <h4>Les récents évènements</h4>
      <div class="project-boxes jsGridView">
      <?php
                foreach ($recent_event as $key => $value) { ?>
        <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #d5deff;">
                <div class="project-box-header">
                    <span><?= date('F j, Y',strtotime($value["date"])) ?></span>
                    <div class="more-wrapper">
                    <button class="project-btn-more">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" /></svg>
                    </button>
                </div>
            </div>
            <div class="project-box-content-header">
                <p class="box-content-header"><?= $value["name"] ?></p>
                <p class="box-content-subheader"><?= $value["price"] ?>€</p>
            </div>
            <div class="box-progress-wrapper">
                <p><?= $value["description"] ?></p>
            </div>
            <div class="project-box-footer">
                <div class="participants">
                    <img src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="participant">
                    <img src="https://images.unsplash.com/photo-1583195764036-6dc248ac07d9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2555&q=80" alt="participant">
                    <button class="add-participant" style="color: #4067f9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <path d="M12 5v14M5 12h14" /></svg>
                    </button>
                </div>
                <div class="days-left" style="color: #4067f9;">
                    <a href="/admin/event/edit/<?= $value["id"] ?>">Modifier</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
    <h4>Les récents forums</h4>
      <div class="project-boxes jsGridView">
      <?php
      foreach ($get_recent_category_forum as $key => $value) { ?>
        <div class="project-box-wrapper">
            <div class="project-box" style="background-color: ##dbf6fd;">
                <div class="project-box-header">
                    <span><?= date('F j, Y',strtotime($value["date"])) ?></span>
                    <div class="more-wrapper">
                    <button class="project-btn-more">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" /></svg>
                    </button>
                </div>
            </div>
            <div class="project-box-content-header">
                <p class="box-content-header"><?= $value["title"] ?></p>
                <p class="box-content-subheader"><?= $value["category_name"] ?></p>
            </div>
            <div class="box-progress-wrapper">
                <p><?php 
                    if (strlen($value["description"]) >= 80) {
                        echo html_entity_decode(substr($value["description"], 0, 80) . "...");
                    } else {
                        echo html_entity_decode($value["description"]);
                    }
                ?></p>
            </div>
            <div class="project-box-footer">
                <div class="participants">
                    <img src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="participant">
                    <img src="https://images.unsplash.com/photo-1583195764036-6dc248ac07d9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2555&q=80" alt="participant">
                    <button class="add-participant" style="color: #4067f9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <path d="M12 5v14M5 12h14" /></svg>
                    </button>
                </div>
                <div class="days-left" style="color: #4067f9;">
                    <a href="/admin/forum/edit/<?= $value["id"] ?>">Modifier</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
</div>


<div class="messages-section">
  <button class="messages-close">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
      <circle cx="12" cy="12" r="10" />
      <line x1="15" y1="9" x2="9" y2="15" />
      <line x1="9" y1="9" x2="15" y2="15" /></svg>
  </button>
  <div class="projects-section-header">
    <p>Commentaires en attente</p>
  </div>
  <?php
  foreach ($forum_commentaire as $key => $value) { ?>
  <div class="messages">
    <div class="message-box">
      <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80" alt="profile image">
      <div class="message-content">
        <div class="message-header">
          <div class="name"><?= $value["user_firstname"]?> <?= $value["user_lastname"]?></div>
          <div class="star-checkbox">
            <input type="checkbox" id="star-1">
            <label for="star-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
            </label>
          </div>
        </div>
        <p class="forum-line"><strong>Forum:</strong> <?= $value["forum_title"]?></p>
        <p class="message-line">
        <?= utf8_encode($value["commentaire"]) ?>
        </p>
        <p class="message-line time">
            <?= date('F j, Y',strtotime($value["createdAt"])) ?>
        </p>
      </div>
    </div>
  </div>
  <?php
    }
    ?>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var modeSwitch = document.querySelector('.mode-switch');

  modeSwitch.addEventListener('click', function () {                     
    document.documentElement.classList.toggle('dark');
    modeSwitch.classList.toggle('active');
  });
  
  var listView = document.querySelector('.list-view');
  var gridView = document.querySelector('.grid-view');
  var projectsList = document.querySelector('.project-boxes');
  
  listView.addEventListener('click', function () {
    gridView.classList.remove('active');
    listView.classList.add('active');
    projectsList.classList.remove('jsGridView');
    projectsList.classList.add('jsListView');
  });
  
  gridView.addEventListener('click', function () {
    gridView.classList.add('active');
    listView.classList.remove('active');
    projectsList.classList.remove('jsListView');
    projectsList.classList.add('jsGridView');
  });
  
  document.querySelector('.messages-btn').addEventListener('click', function () {
    document.querySelector('.messages-section').classList.add('show');
  });
  
  document.querySelector('.messages-close').addEventListener('click', function() {
    document.querySelector('.messages-section').classList.remove('show');
  });
});
</script>