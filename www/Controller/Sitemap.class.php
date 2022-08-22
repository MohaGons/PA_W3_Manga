<?php

namespace App\Controller;

use App\Core\Session as Session;
use App\Core\View;
use App\Repository\Page as PageRepository;
use App\Repository\Event as EventRepository;
use App\Repository\Forum as ForumRepository;
use App\Repository\Manga as MangaRepository;

class Sitemap
{
    public function index()
    {
        $page_data = PageRepository::all();
        $event_data = EventRepository::all();
        $forum_data = ForumRepository::all();
        $manga_data = MangaRepository::all();

        $view = new View("sitemap", "sitemap");
        $view->assign("page_data", $page_data);
        $view->assign("event_data", $event_data);
        $view->assign("forum_data", $forum_data);
        $view->assign("manga_data", $manga_data);
    }
}