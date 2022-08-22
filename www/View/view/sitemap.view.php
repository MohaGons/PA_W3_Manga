<?php ob_start(); ?>

<h1>Sitemap</h1>

<br>
<span><?= htmlspecialchars("<?xml version='1.0' encoding='UTF-8'?>") ?></span><br>
<span><?= htmlspecialchars("<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xhtml='http://www.w3.org/1999/xhtml' xmlns:image='http://www.google.com/schemas/sitemap-image/1.1' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>") ?></span><br>

<span class="one"><?= htmlspecialchars("<url>") ?></span><br>
<span class="two"> <?= htmlspecialchars("<loc>http://vps-9699f85b.vps.ovh.net/") ?></span><br>
<span class="two">
    <?= htmlspecialchars("<changefreq>daily</changefreq>") ?>
</span><br>
<span class="two">
    <?= htmlspecialchars("<priority>1.0</priority>") ?>
</span><br>
<span class="one"><?= htmlspecialchars("</url>") ?></span><br>

<?php if(isset($page_data)) {?>
<?php foreach ($page_data as $page) { ?>
    <span class="one"><?= htmlspecialchars("<url>") ?></span><br>
    <span class="two"> <?= htmlspecialchars('<loc>http://vps-9699f85b.vps.ovh.net/'. strtolower(str_replace(" ", "-", $page['title'])) .'</loc>') ?></span><br>
    <span class="three">
        <?= isset($page['updatedAt'])
            ?  htmlspecialchars("<lastmod>" . (new \Datetime($page['updatedAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>")
            :  htmlspecialchars("<lastmod>" . (new \Datetime($page['createdAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<changefreq>daily</changefreq>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<priority>1.0</priority>") ?>
    </span><br>
    <span class="one"><?= htmlspecialchars("</url>") ?></span><br>
<?php } ?>
<?php } ?>
<br>
<?php foreach ($event_data as $event) : ?>
    <span class="two"><?= htmlspecialchars("<url>") ?></span><br>
    <span class="three"> <?= htmlspecialchars('<loc>http://vps-9699f85b.vps.ovh.net/event/detail/'. $event['id'] .'</loc>') ?></span><br>
    <span class="three">
        <?= isset($event['updatedAt'])
            ?  htmlspecialchars("<lastmod>" . (new \Datetime($event['updatedAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>")
            :  htmlspecialchars("<lastmod>" . (new \Datetime($event['createdAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<changefreq>daily</changefreq>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<priority>1.0</priority>") ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("<image:image>") ?></span><br>
    <span class="four">
        <?= strstr($event['photo'], 'https') == true
            ?  htmlspecialchars("<image:loc>" .  $event['photo'] . "</image:loc>")
            : htmlspecialchars('<image:loc>http://vps-9699f85b.vps.ovh.net/Style/images/Evenements/' .  $event['photo'] . '</image:loc>')
        ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("</image:image>") ?></span><br>
    <span class="two"><?= htmlspecialchars("</url>") ?></span><br>
<?php endforeach ?>
<br>
<?php foreach ($forum_data as $forum) : ?>
    <span class="two"><?= htmlspecialchars("<url>") ?></span><br>
    <span class="three"> <?= htmlspecialchars('<loc>http://vps-9699f85b.vps.ovh.net/forum/detail/'. $forum['id'] .'</loc>') ?></span><br>
    <span class="three">
        <?= isset($forum['updatedAt'])
            ?  htmlspecialchars("<lastmod>" . (new \Datetime($forum['updatedAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>")
            :  htmlspecialchars("<lastmod>" . (new \Datetime($forum['createdAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<changefreq>daily</changefreq>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<priority>1.0</priority>") ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("<image:image>") ?></span><br>
    <span class="four">
        <?= strstr($forum['picture'], 'https') == true
            ?  htmlspecialchars("<image:loc>" .  $forum['picture'] . "</image:loc>")
            : htmlspecialchars('<image:loc>http://vps-9699f85b.vps.ovh.net/Style/images/Forums/' .  $forum['picture'] . '</image:loc>')
        ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("</image:image>") ?></span><br>
    <span class="two"><?= htmlspecialchars("</url>") ?></span><br>
<?php endforeach ?>
<br>
<?php foreach ($manga_data as $manga) : ?>
    <span class="two"><?= htmlspecialchars("<url>") ?></span><br>
    <span class="three"> <?= htmlspecialchars('<loc>http://vps-9699f85b.vps.ovh.net/manga/detail/'. $manga['id'] .'</loc>') ?></span><br>
    <span class="three">
        <?= isset($manga['updatedAt'])
            ?  htmlspecialchars("<lastmod>" . (new \Datetime($manga['updatedAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>")
            :  htmlspecialchars("<lastmod>" . (new \Datetime($manga['createdAt']))->format('Y-m-d' . 'T' . 'H:i:s' . 'Z') . "</lastmod>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<changefreq>daily</changefreq>") ?>
    </span><br>
    <span class="three">
        <?= htmlspecialchars("<priority>1.0</priority>") ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("<image:image>") ?></span><br>
    <span class="four">
        <?= strstr($manga['image'], 'https') == true
            ?  htmlspecialchars("<image:loc>" .  $manga['image'] . "</image:loc>")
            : htmlspecialchars('<image:loc>http://vps-9699f85b.vps.ovh.net/Style/images/Mangas/' .  $manga['image'] . '</image:loc>')
        ?>
    </span><br>
    <span class="three"> <?= htmlspecialchars("</image:image>") ?></span><br>
    <span class="two"><?= htmlspecialchars("</url>") ?></span><br>
<?php endforeach ?>
<span class="two"><?= htmlspecialchars("</urlset>") ?></span><br>


<style>
    .one {
        margin-left: 30px;
    }

    .two {
        margin-left: 60px;
    }

    .three {
        margin-left: 90px;
    }

    .four {
        margin-left: 120px;
    }
</style>