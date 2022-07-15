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
$user_one->setPays(htmlspecialchars('France'));
$user_one->setVille(htmlspecialchars('Paris'));

$user_two->setFirstname(htmlspecialchars('John'));
$user_two->setLastname(htmlspecialchars('Doe'));
$user_two->setEmail(htmlspecialchars('johndoe@gmail.com'));
$user_two->setStatus(htmlspecialchars('0'));
$user_two->setPassword(htmlspecialchars('Test1234'));
$user_two->setAvatar(htmlspecialchars('avatar.png'));
$user_two->setGender(htmlspecialchars('m'));
$user_two->setRole(htmlspecialchars('1'));
$user_two->setPays(htmlspecialchars('France'));
$user_two->setVille(htmlspecialchars('Paris'));

//MIGRATION CREATE TABLE MANGA

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
$manga_three->save();

//MIGRATION CREATE TABLE PASSWORD

$password = new Password();

//MIGRATION CREATE TABLE ROLE

$role_one = new Role();
$role_two = new Role();
$role_three = new Role();

$role->setRole(htmlspecialchars('Abonne'));
$role_two->setRole(htmlspecialchars('Editeur'));
$role_three->setRole(htmlspecialchars('Admin'));

//MIGRATION CREATE TABLE FORUM

$forum = new Forum();

$forum->setTitle(htmlspecialchars('Titre du forum'));
$forum->setDescription(htmlspecialchars('Description du forum'));
$forum->setPicture(htmlspecialchars('forum.jpg'));
$forum->setCategoryId(htmlspecialchars('1'));
$forum->setUserId(htmlspecialchars('1'));
$forum->setDate(htmlspecialchars('2019-01-01'));

//MIGRATION CREATE TABLE CATEGORY

$category_one = new Category();
$category_two = new Category();

$category_one->setName(htmlspecialchars('Action'));
$category_one->setDescription(htmlspecialchars('Action'));

$category_two->setName(htmlspecialchars('Fantastique'));
$category_two->setDescription(htmlspecialchars('Fantastique'));

//MIGRATION CREATE TABLE EVENT

$event_one = new Event();
$event_two = new Event();

$event_one->setName(htmlspecialchars('Event'));
$event_one->setDescription(htmlspecialchars('Event'));
$event_one->setDate(htmlspecialchars('2019-01-01'));
$event_one->setPrice(htmlspecialchars('10'));
$event_one->setPhoto(htmlspecialchars('event.jpg'));

$event_two->setName(htmlspecialchars('Film'));
$event_two->setDescription(htmlspecialchars('Film'));
$event_two->setDate(htmlspecialchars('2019-01-01'));
$event_two->setPrice(htmlspecialchars('10'));
$event_two->setPhoto(htmlspecialchars('film.jpg'));

//MIGRATION CREATE TABLE FORUMCOMMENTAIRE

$forumcommantaire_one = new ForumCommentaire();
$forumcommantaire_two = new ForumCommentaire();

$forumcommantaire_one->setForumId(htmlspecialchars('1'));
$forumcommantaire_one->setUserId(htmlspecialchars('1'));
$forumcommantaire_one->setCommentaire(htmlspecialchars('Commentaire'));
$forumcommantaire_one->setDateCreation(htmlspecialchars('2019-01-01'));
$forumcommantaire_one->setIsValid(htmlspecialchars('0'));

$forumcommantaire_two->setForumId(htmlspecialchars('1'));
$forumcommantaire_two->setUserId(htmlspecialchars('1'));
$forumcommantaire_two->setCommentaire(htmlspecialchars('Commentaire'));
$forumcommantaire_two->setDateCreation(htmlspecialchars('2019-01-01'));
$forumcommantaire_two->setIsValid(htmlspecialchars('1'));

//MIGRATION CREATE TABLE MEDIA

$media = new Media();

$media->setName(htmlspecialchars('media.jpg'));
$media->setCategorie(htmlspecialchars('Media'));
$media->setUser(htmlspecialchars('mohagonssaib@gmail.com'));
$media->setDate(htmlspecialchars('2019-01-01'));
