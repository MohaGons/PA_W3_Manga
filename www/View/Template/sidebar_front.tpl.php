<?php use App\Core\Session as Session; ?>
<nav id="site-nav" class="">
    <ul>
        <li><a href="/">Accueil</a></li>

        <?php
        $session = new Session();
        if (!empty($session->get('email'))){
            echo "<li><a href='/logout'>Logout</a></li>";
        }
        else{
           echo "<li><a href='/login'>Login</a></li>";
           echo "<li><a href='/register'>Register</a></li>";
        }?>
        <!-- <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li> -->

        