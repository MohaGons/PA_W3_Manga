<?php

namespace App\Core;

use App\Core\SplSubject;
use App\Model\Manga;

interface SplObserver
{
    public function updateNewsletter(Manga $manga, array $userInfo): void;
}
