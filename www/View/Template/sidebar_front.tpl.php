<?php 
use App\Core\Session as Session;
use App\Repository\Page as PageRepository;
?>
<nav id="site-nav" class="">
    <ul>
        <li><a href="/">Accueil</a></li>

        <?php foreach (PageRepository::all() as $page) { ?>
            <li><a href="/<?= strtolower(str_replace(" ", "-", $page['title'])) ?>"><?= $page['title'] ?></a></li>
        <?php } ?>

        <?php
        $session = new Session();
        if (!empty($session->get('email'))){
            echo "<li><a href='/logout'>Logout</a></li>";
        }
        else{
           echo "<li><a href='/login'>Login</a></li>";
           echo "<li><a href='/register'>Register</a></li>";
        }?>