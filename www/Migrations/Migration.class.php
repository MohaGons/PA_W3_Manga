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
use App\Model\Page;

//MIGRATION CREATE TABLE USER
$user = new User();

$colums = $user->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["firstname"] = "varchar(25) NOT NULL,";
$colums["lastname"] = "varchar(100) NOT NULL,";
$colums["email"] = "varchar(320) NOT NULL,";
$colums["status"] = "tinyint(4) NOT NULL,";
$colums["password"] = "varchar(255) NOT NULL,";
$colums["token"] = "char(255) DEFAULT NULL,";
$colums["avatar"] = "varchar(255) NOT NULL,";
$colums["gender"] = "varchar(1) NOT NULL,";
$colums["role"] = "int(1) NOT NULL,";
$colums["pays"] = "varchar(50) NOT NULL,";
$colums["ville"] = "varchar(100) NOT NULL,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$user->createTable($colums);

//MIGRATION CREATE TABLE MANGA
$manga = new Manga();

$colums = $manga->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["type"] = "varchar(10) NOT NULL,";
$colums["title"] = "varchar(255) NOT NULL,";
$colums["description"] = "varchar(400) NOT NULL,";
$colums["image"] = "varchar(100) NOT NULL,";
$colums["release_date"] = "date NOT NULL,";
$colums["author"] = "varchar(50) NOT NULL,";
$colums["status"] = "varchar(20) NOT NULL,";
$colums["category"] = "varchar(20) NOT NULL,";
$colums["nb_tomes"] = "int(11) NOT NULL,";
$colums["nb_chapters"] = "int(11) NOT NULL,";
$colums["nb_episodes"] = "int(11) NOT NULL,";
$colums["diffusion"] = "varchar(100) NOT NULL,";
$colums["nb_seasons"] = "int(11) NOT NULL,";
$colums["production_studio"] = "varchar(50) NOT NULL,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$manga->createTable($colums);

//MIGRATION CREATE TABLE PASSWORD
$password = new Password();

$colums = $password->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["email"] = "varchar(255) NOT NULL,";
$colums["date_demande"] = "int(11) NOT NULL,";
$colums["token"] = "varchar(255) NOT NULL,";
$colums["statut"] = "int(11) NOT NULL DEFAULT '0',";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$password->createTable($colums);

//MIGRATION CREATE TABLE ROLE
$role = new Role();

$colums = $role->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["role"] = "varchar(50) DEFAULT 'abonné',";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$role->createTable($colums);

//MIGRATION CREATE TABLE FORUM
$forum = new Forum();

$colums = $forum->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["title"] = "varchar(100) NOT NULL,";
$colums["description"] = "text,";
$colums["picture"] = "varchar(255) NOT NULL,";
$colums["category_id"] = "int(11) NOT NULL,";
$colums["user_id"] = "int(11) NOT NULL,";
$colums["date"] = "timestamp NULL DEFAULT NULL,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$forum->createTable($colums);

//MIGRATION CREATE TABLE CATEGORY
$category = new Category();

$colums = $category->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["name"] = "varchar(100) NOT NULL,";
$colums["description"] = "text,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$category->createTable($colums);

//MIGRATION CREATE TABLE EVENT

$event = new Event();

$colums = $event->getColums();
$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["name"] = "varchar(50) NOT NULL,";
$colums["description"] = "varchar(320) NOT NULL,";
$colums["date"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["price"] = "int(11) NOT NULL,";
$colums["photo"] = "varchar(255) NOT NULL,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";


$event->createTable($colums);

//MIGRATION CREATE TABLE FORUMCOMMENTAIRE

$forumcommantaire = new ForumCommentaire();

$colums = $forumcommantaire->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["id_forum"] = "int(11) NOT NULL,";
$colums["id_user"] = "int(11) NOT NULL,";
$colums["commentaire"] = "text,";
$colums["isValid"] = "tinyint(1) DEFAULT '0',";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$forumcommantaire->createTable($colums);

//MIGRATION CREATE TABLE MEDIA

$media = new Media();

$colums = $media->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["name"] = "varchar(255) NOT NULL,";
$colums["categorie"] = "varchar(255) NULL,";
$colums["user"] = "varchar(255) NOT NULL,";
$colums["date"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
$colums["updatedAt"] = "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";

$media->createTable($colums);

//MIGRATION CREATE TABLE PAGE

$page = new Page();

$colums = $page->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["title"] = "varchar(100) NOT NULL,";
$colums["description"] = "text,";
$colums["page"] = "varchar(50) NOT NULL,";
$colums["user_id"] = "int(11) NOT NULL";

$page->createTable($colums);
