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

//MIGRATION CREATE TABLE USER
$user = new User();

$colums = $user->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["email"] = "varchar(320) NOT NULL,";
$colums["password"] = "varchar(255) NOT NULL,";
$colums["firstname"] = "varchar(25) NOT NULL,";
$colums["lastname"] = "varchar(100) NOT NULL,";
$colums["status"] = "tinyint(4) NOT NULL,";
$colums["token"] = "char(255) DEFAULT NULL,";
$colums["role"] = "int(1) NOT NULL,";
$colums["gender"] = "varchar(1) NOT NULL,";
$colums["avatar"] = "varchar(255) NOT NULL,";
$colums["createdAt"] = "timestamp NULL DEFAULT NULL,";
$colums["updatedAt"] = "timestamp NULL DEFAULT NULL";

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
$colums["production_studio"] = "varchar(50) NOT NULL";

$manga->createTable($colums);

//MIGRATION CREATE TABLE PASSWORD
$password = new Password();

$colums = $password->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["email"] = "varchar(255) NOT NULL,";
$colums["date_demande"] = "int(11) NOT NULL,";
$colums["token"] = "varchar(255) NOT NULL,";
$colums["statut"] = "int(11) NOT NULL DEFAULT '0'";

$password->createTable($colums);

//MIGRATION CREATE TABLE ROLE
$role = new Role();

$colums = $role->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["role"] = "varchar(50) DEFAULT 'abonné'";

$role->createTable($colums);

//MIGRATION CREATE TABLE FORUM
$forum = new Forum();

$colums = $forum->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["title"] = "varchar(100) NOT NULL,";
$colums["description"] = "text,";
$colums["picture"] = "varchar(255) NOT NULL,";
$colums["category_id"] = "int(11) NOT NULL,";
$colums["user_id"] = "int(11) NOT NULL";

$forum->createTable($colums);

//MIGRATION CREATE TABLE CATEGORY
$category = new Category();

$colums = $category->getColums();

$colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
$colums["name"] = "varchar(100) NOT NULL,";
$colums["description"] = "text";

$category->createTable($colums);
