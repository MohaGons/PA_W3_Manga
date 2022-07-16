<?php

namespace App\Migrations;

require __DIR__.'/../conf.inc.php';

function myAutoloader( $class )
{

    // $class -> "Core\Security" "Model\User
    $class = str_ireplace("App\\","",$class);

    // $class -> "Core/Security" "Model/User
    $class = str_replace("\\","/",$class);


    // $class -> "Core/Security"
    if(file_exists("../".$class.".class.php")){
        include "../".$class.".class.php";
    }

}

spl_autoload_register("App\Migrations\myAutoloader");

use App\Model\Category;
use App\Model\Forum;
use App\Model\Password;
use App\Model\Role;
use App\Model\User;
use App\Model\Manga;
use App\Model\Event;
use App\Model\ForumCommentaire;
use App\Model\Media;

//MIGRATION CREATE TABLE USER

$user = new User();
$user->deleteTable();

$user_one = new User();
$user_two = new User();

$user_one->setFirstname(htmlspecialchars('Moha'));
$user_one->setLastname(htmlspecialchars('GS'));
$user_one->setEmail(htmlspecialchars('mohagonssaib@gmail.com'));
$user_one->setStatus(htmlspecialchars('0'));
$user_one->setPassword(htmlspecialchars('Test1234'));
$user_one->setAvatar(htmlspecialchars('avatar.png'));
$user_one->setGender(htmlspecialchars('m'));
$user_one->setRole(htmlspecialchars('3'));
$user_one->setPays('Pays');
$user_one->setPays('Ville');
$user_one->setCreatedAt(date("Y-m-d H:i:s"));
$user_one->save();

$user_two->setFirstname(htmlspecialchars('John'));
$user_two->setLastname(htmlspecialchars('Doe'));
$user_two->setEmail(htmlspecialchars('johndoe@gmail.com'));
$user_two->setStatus(htmlspecialchars('0'));
$user_two->setPassword(htmlspecialchars('Test1234'));
$user_two->setAvatar(htmlspecialchars('avatar.png'));
$user_two->setGender(htmlspecialchars('m'));
$user_two->setRole(htmlspecialchars('1'));
$user_two->setPays('Pays');
$user_two->setPays('Ville');
$user_two->setCreatedAt(date("Y-m-d H:i:s"));
$user_two->save();

//MIGRATION CREATE TABLE MANGA

$manga = new Manga();
$manga->deleteTable();

$manga_one = new Manga();
$manga_two = new Manga();
$manga_three = new Manga();

$manga_one->setTypeManga(htmlspecialchars('Manga'));
$manga_one->setTitleManga(htmlspecialchars('Naruto'));
$manga_one->setDescriptionManga(htmlspecialchars('Naruto est un manga'));
$manga_one->setImageManga(htmlspecialchars('naruto.jpg'));
$manga_one->setReleaseDateManga(htmlspecialchars('2019-01-01'));
$manga_one->setAuthorManga(htmlspecialchars('Masashi Kishimoto'));
$manga_one->setStatusManga(htmlspecialchars('En cours'));
$manga_one->setCategoryManga(htmlspecialchars('Action'));
$manga_one->setNbTomesManga(htmlspecialchars('100'));
$manga_one->setNbChaptersManga(htmlspecialchars('10'));
$manga_one->setNbEpisodesManga(htmlspecialchars('10'));
$manga_one->setDiffusionManga(htmlspecialchars('2019-01-01'));
$manga_one->setNbSeasonsManga(htmlspecialchars('10'));
$manga_one->setProductionStudioManga(htmlspecialchars('Konami'));
$manga_one->setCreatedAt(date("Y-m-d H:i:s"));
$manga_one->save();

$manga_two->setTypeManga(htmlspecialchars('Manga'));
$manga_two->setTitleManga(htmlspecialchars('Bleach'));
$manga_two->setDescriptionManga(htmlspecialchars('Bleach est un manga'));
$manga_two->setImageManga(htmlspecialchars('bleach.jpg'));
$manga_two->setReleaseDateManga(htmlspecialchars('2019-01-01'));
$manga_two->setAuthorManga(htmlspecialchars('Tite Kubo'));
$manga_two->setStatusManga(htmlspecialchars('En cours'));
$manga_two->setCategoryManga(htmlspecialchars('Action'));
$manga_two->setNbTomesManga(htmlspecialchars('100'));
$manga_two->setNbChaptersManga(htmlspecialchars('10'));
$manga_two->setNbEpisodesManga(htmlspecialchars('10'));
$manga_two->setDiffusionManga(htmlspecialchars('2019-01-01'));
$manga_two->setNbSeasonsManga(htmlspecialchars('10'));
$manga_two->setProductionStudioManga(htmlspecialchars('Konami'));
$manga_two->setCreatedAt(date("Y-m-d H:i:s"));
$manga_two->save();

$manga_three->setTypeManga(htmlspecialchars('Manga'));
$manga_three->setTitleManga(htmlspecialchars('One piece'));
$manga_three->setDescriptionManga(htmlspecialchars('One piece est un manga'));
$manga_three->setImageManga(htmlspecialchars('onepiece.jpg'));
$manga_three->setReleaseDateManga(htmlspecialchars('2019-01-01'));
$manga_three->setAuthorManga(htmlspecialchars('Eiichiro Oda'));
$manga_three->setStatusManga(htmlspecialchars('En cours'));
$manga_three->setCategoryManga(htmlspecialchars('Action'));
$manga_three->setNbTomesManga(htmlspecialchars('100'));
$manga_three->setNbChaptersManga(htmlspecialchars('10'));
$manga_three->setNbEpisodesManga(htmlspecialchars('10'));
$manga_three->setDiffusionManga(htmlspecialchars('2019-01-01'));
$manga_three->setNbSeasonsManga(htmlspecialchars('10'));
$manga_three->setProductionStudioManga(htmlspecialchars('Konami'));
$manga_three->setCreatedAt(date("Y-m-d H:i:s"));
$manga_three->save();

//MIGRATION CREATE TABLE PASSWORD

$password = new Password();
$password->deleteTable();

//MIGRATION CREATE TABLE ROLE

$role = new Role();
$role->deleteTable();

$role_one = new Role();
$role_two = new Role();
$role_three = new Role();

//$role_one->setId('1');
$role_one->setRole(htmlspecialchars('Abonne'));
$role_one->setCreatedAt(date("Y-m-d H:i:s"));
$role_one->save();

//$role_two->setId('2');
$role_two->setRole(htmlspecialchars('Editeur'));
$role_two->setCreatedAt(date("Y-m-d H:i:s"));
$role_two->save();

//$role_three->setId('3');
$role_three->setRole(htmlspecialchars('Admin'));
$role_three->setCreatedAt(date("Y-m-d H:i:s"));
$role_three->save();

//MIGRATION CREATE TABLE FORUM

$forum = new Forum();
$forum->deleteTable();

$forum->setTitleForum(htmlspecialchars('Titre du forum'));
$forum->setDescriptionForum(htmlspecialchars('Description du forum'));
$forum->setCategoryId(htmlspecialchars('1'));
$forum->setUserId(htmlspecialchars('1'));
$forum->setDate(htmlspecialchars('2019-01-01'));
$forum->setCreatedAt(date("Y-m-d H:i:s"));
$forum->save();

//MIGRATION CREATE TABLE CATEGORY

$category = new Category();
$category->deleteTable();

$category_one = new Category();
$category_two = new Category();

$category_one->setNameCategory(htmlspecialchars('Action'));
$category_one->setDescriptionCategory(htmlspecialchars('Action'));
$category_one->setCreatedAt(date("Y-m-d H:i:s"));
$category_one->save();

$category_two->setNameCategory(htmlspecialchars('Fantastique'));
$category_two->setDescriptionCategory(htmlspecialchars('Fantastique'));
$category_two->setCreatedAt(date("Y-m-d H:i:s"));
$category_two->save();

//MIGRATION CREATE TABLE EVENT

$event = new Event();
$event->deleteTable();

$event_one = new Event();
$event_two = new Event();

$event_one->setName(htmlspecialchars('Event'));
$event_one->setDescription(htmlspecialchars('Event'));
$event_one->setDate(htmlspecialchars('2019-01-01'));
$event_one->setPrice(htmlspecialchars('10'));
$event_one->setPhoto(htmlspecialchars('event.jpg'));
$event_one->setCreatedAt(date("Y-m-d H:i:s"));
$event_one->save();

$event_two->setName(htmlspecialchars('Film'));
$event_two->setDescription(htmlspecialchars('Film'));
$event_two->setDate(htmlspecialchars('2019-01-01'));
$event_two->setPrice(htmlspecialchars('10'));
$event_two->setPhoto(htmlspecialchars('film.jpg'));
$event_two->setCreatedAt(date("Y-m-d H:i:s"));
$event_two->save();

//MIGRATION CREATE TABLE FORUMCOMMENTAIRE

$forumCommentaire = new ForumCommentaire();
$forumCommentaire->deleteTable();

$forumcommantaire_one = new ForumCommentaire();
$forumcommantaire_two = new ForumCommentaire();

$forumcommantaire_one->setForumId(htmlspecialchars('1'));
$forumcommantaire_one->setUserId(htmlspecialchars('1'));
$forumcommantaire_one->setCommentaire(htmlspecialchars('Commentaire'));
$forumcommantaire_one->setIsValid(htmlspecialchars('0'));
$forumcommantaire_one->setCreatedAt(date("Y-m-d H:i:s"));
$forumcommantaire_one->save();

$forumcommantaire_two->setForumId(htmlspecialchars('1'));
$forumcommantaire_two->setUserId(htmlspecialchars('1'));
$forumcommantaire_two->setCommentaire(htmlspecialchars('Commentaire'));
$forumcommantaire_two->setIsValid(htmlspecialchars('1'));
$forumcommantaire_two->setCreatedAt(date("Y-m-d H:i:s"));
$forumcommantaire_two->save();

//MIGRATION CREATE TABLE MEDIA

$media = new Media();
$media->deleteTable();

$media->setName(htmlspecialchars('media.jpg'));
$media->setCategorie(htmlspecialchars('Media'));
$media->setUser(htmlspecialchars('mohagonssaib@gmail.com'));
$media->setDate(htmlspecialchars('2019-01-01'));
$media->setCreatedAt(date("Y-m-d H:i:s"));
$media->save();
