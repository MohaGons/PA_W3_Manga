<?php

namespace App\Core;

use App\Core\Session as Session;
use App\Core\View as View;
use App\Core\Env as Env;
use App\Core\Security;
use App\Model\Category;
use App\Model\Event;
use App\Model\Forum;
use App\Model\ForumCommentaire;
use App\Model\Manga;
use App\Model\Media;
use App\Model\Page;
use App\Model\Password;
use App\Model\Role;
use App\Model\User;
use App\Model\User as UserModel;
use App\Repository\User as UserRepository;

class Install extends MysqlBuilder
{
    public function __construct()
    {

        parent::__construct();
    }

    public static function check(): bool
    {
        $fileName = "conf.inc.php";
        if (!file_exists($fileName)){
            return false;
        }
        else {
            return true;
        }

    }

    public static function start()
    {
        Session::destroy();
        $install = Install::formBuilderInstall();
        $errors = [];


        if (!empty($_POST)) {
            $result = Verificator::checkFormInstaller(Install::formBuilderInstall(), $_POST);

            $data = [];
            if (empty($result)) {
                $data["WEBSITE_NAME"] = htmlspecialchars($_POST["WEBSITE_NAME"]);
                $data["WEBSITE_CONTACT_ADDRESS"] = htmlspecialchars($_POST["WEBSITE_CONTACT_ADDRESS"]);
                $data["WEBSITE_ADMIN"] = htmlspecialchars($_POST["WEBSITE_ADMIN"]);
                $data["WEBSITE_PASSWORD"] = htmlspecialchars($_POST["WEBSITE_PASSWORD"]);
                $data["DB_NAME"] = htmlspecialchars($_POST["DB_NAME"]);
                $data["DB_PREFIXE"] = htmlspecialchars($_POST["DB_PREFIXE"]);
                $data["EMAIL_SOURCE_NAME"] = htmlspecialchars($_POST["EMAIL_SOURCE_NAME"]);
                $data["EMAIL_SMTP_HOST"] = htmlspecialchars($_POST["EMAIL_SMTP_HOST"]);
                $data["EMAIL_SMTP_ADMIN"] = htmlspecialchars($_POST["EMAIL_SMTP_ADMIN"]);
                $data["EMAIL_SMTP_PASSWORD"] = htmlspecialchars($_POST["EMAIL_SMTP_PASSWORD"]);
                $data["EMAIL_SMTP_PORT"] = htmlspecialchars($_POST["EMAIL_SMTP_PORT"]);
                $install = Install::execute($data);

                $colums = [];

                $colums["WEBSITE_ADMIN"] = $data["WEBSITE_ADMIN"];
                $colums["WEBSITE_PASSWORD"] = $data["WEBSITE_PASSWORD"];
                $colums["DB_NAME"] = $data["DB_NAME"];
                $colums["DB_PREFIXE"] = $data["DB_PREFIXE"];

                return $colums;

            }
            else {
                $errors = $result;
            }
        }

        $view = new View("installer/install", "install");
        $view->assign("install", $install);
        $view->assign("errors", $errors);

    }

    private static function formBuilderInstall()
    {
        return  [
            "config" => [
                "method" => "POST",
                "action" => "#",
                "id" => "formInstall",
                "class"=>"formRegister",
                "submit" => "Enregister",
            ],

            "inputs" => [
                "WEBSITE_NAME" => [
                    "id" => "websiteNameInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Nom du site web : ",
                    "placeholder" => "Le nom affiché sur le site web",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "mangasite.com"
                ],

                "WEBSITE_CONTACT_ADDRESS" => [
                    "id" => "websiteContactAddressInstall",
                    "type" => "email",
                    'class' => 'formRegister',
                    "label" => "Adresse mail de contact : ",
                    "placeholder" => "Adresse email de contact",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "mangasite2022@gmail.com"
                ],

                "WEBSITE_ADMIN" => [
                    "id" => "websiteAdminInstall",
                    "type" => "email",
                    'class' => 'formRegister',
                    "label" => "Admin du site : ",
                    "placeholder" => "Choisissez un identifiant pour le super-admin",
                    "required"=>true,
                    "value" => "fassory.diaby@gmail.com"
                ],

                "WEBSITE_PASSWORD" => [
                    "id" => "websitePasswordInstall",
                    "type" => "password",
                    'class' => 'formRegister',
                    "label" => "Mot de passe du site : ",
                    "placeholder" => "Choisissez un mot de passe pour le super-admin",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "error" => "test",
                    "required"=>true,
                    "value" => "Admintest_12345"
                ],
                "DB_NAME" => [
                    "id" => "dbNametInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Nom",
                    "placeholder" => "Nom de la base de données : ",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => ""
                ],
                "DB_PREFIXE" => [
                    "id" => "dbDriverInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Préfixe table en base : ",
                    "placeholder" => "Préfixe table en base : ",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "mnga_"
                ],
                "EMAIL_SOURCE_NAME" => [
                    "id" => "emailSourceNameInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Nom SMTP : ",
                    "placeholder" => "Le nom affiché aux destinataires des emails",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "no-reply@mangasite.fr"
                ],
                "EMAIL_SMTP_HOST" => [
                    "id" => "emailSmtpHostInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Serveur SMTP : ",
                    "placeholder" => "Votre serveur SMTP",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "smtp.gmail.com"
                ],
                "EMAIL_SMTP_ADMIN" => [
                    "id" => "emailSmtpAdminInstall",
                    "type" => "email",
                    'class' => 'formRegister',
                    "label" => "Adresse SMTP : ",
                    "placeholder" => "Votre adresse SMTP",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "mangasite2022@gmail.com"
                ],
                "EMAIL_SMTP_PASSWORD" => [
                    "id" => "emailSmtpPasswordInstall",
                    "type" => "password",
                    'class' => 'formRegister',
                    "label" => "Mot de passe SMTP : ",
                    "placeholder" => "Votre mot de passe SMTP",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                        "value" => "namvkbbhnlpokjqr"
                ],
                "EMAIL_SMTP_PORT" => [
                    "id" => "emailSmtpPortInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Port SMTP : ",
                    "placeholder" => "Le port du serveur SMTP",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "465"
                ],
            ]
        ];
    }

    public static function execute($data)
    {
        $dbDriver = "mysql";
        $dbPort = "3306";
        $dbHost = "database";
        $dbUser = "root";
        $dbPassword = "password";
        $dbName = "pa_database";
        $dbPrefix = "mnga_";

        $configFile = fopen("conf.inc.php", "w");
        fwrite($configFile, "\n");
        fwrite($configFile, "<?php");
        fwrite($configFile, "\n");
        $config = 'define("WEBSITE_NAME","' . $data["WEBSITE_NAME"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("WEBSITE_CONTACT_ADDRESS","' . $data["WEBSITE_CONTACT_ADDRESS"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("ENV","prod");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_HOST","' . $dbHost . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_DRIVER","' . $dbDriver . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PORT","' . $dbPort . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_NAME","' . $dbName . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PREFIXE","' . $dbPrefix . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_USER","' . $dbUser . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PASSWORD","' . $dbPassword . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("EMAIL_SOURCE_NAME","' . $data["EMAIL_SOURCE_NAME"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("EMAIL_SMTP_HOST","' . $data["EMAIL_SMTP_HOST"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("EMAIL_SMTP_ADMIN","' . $data["EMAIL_SMTP_ADMIN"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("EMAIL_SMTP_PASSWORD","' . $data["EMAIL_SMTP_PASSWORD"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("EMAIL_SMTP_PORT","' . $data["EMAIL_SMTP_PORT"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");

        return true;
    }

    public static function createDatabaseAndTable($dbName, $dbPrefix)
    {
        $userModel = new UserModel();
        $userModel->createDatabase($dbName);

        $content = file_get_contents('conf.inc.php');
        $content = explode('define', $content);

        $content[7] = 'define("DB_NAME","' . $dbName . '");';
        $content[8] = 'define("DB_PREFIXE","' . $dbPrefix . '");';

        $new_content  = implode("\n", $content);

        $conf = file_put_contents('conf.inc.php', $new_content);

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
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

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
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

        $password->createTable($colums);

        //MIGRATION CREATE TABLE ROLE
        $role = new Role();

        $colums = $role->getColums();

        $colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        $colums["role"] = "varchar(50) DEFAULT 'abonné',";
        $colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

        $role->createTable($colums);

        //MIGRATION CREATE TABLE FORUM
        $forum = new Forum();

        $colums = $forum->getColums();

        $colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        $colums["title"] = "varchar(100) NOT NULL,";
        $colums["description"] = "text,";
        $colums["category_id"] = "int(11) NOT NULL,";
        $colums["user_id"] = "int(11) NOT NULL,";
        $colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

        $forum->createTable($colums);

        //MIGRATION CREATE TABLE CATEGORY
        $category = new Category();

        $colums = $category->getColums();

        $colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        $colums["user_id"] = "int(11) NOT NULL,";
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
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

        $forumcommantaire->createTable($colums);

        //MIGRATION CREATE TABLE MEDIA

        $media = new Media();

        $colums = $media->getColums();

        $colums["id"] = "int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        $colums["name"] = "varchar(255) NOT NULL,";
        $colums["categorie"] = "varchar(255) NULL,";
        $colums["user"] = "varchar(255) NOT NULL,";
        $colums["createdAt"] = "TIMESTAMP NULL DEFAULT NULL,";
        $colums["updatedAt"] = "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

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


    }

    public static function createUserAdmin($admin, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        UserRepository::createUserAdmin($admin, $password);
    }
}
