<nav id="site-nav" class="">
    <ul>
        <li><a href="#">ACTUALITÉS</a></li>
        <li><a href="#">PLANNING</a></li>
        <li><a href="#">ÉVÈNEMENTS</a></li>
        <li><a href="#">ARTICLES</a></li>

        <?php if (empty($role) ) { ?>
            <li><a href="/login">LOGIN</a></li>
            <li><a href="#">|</a></li>
            <li><a href="/register">REGISTER</a></li>
        <?php }
        else { ?>
            <li><a href="/logout">LOGOUT</a></li>
        <?php } ?>

        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
    </ul>
</nav>