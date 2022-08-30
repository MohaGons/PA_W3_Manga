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

                $dbDriver = "mysql";
                $dbPort = "3306";
                $dbHost = "database";
                $dbUser = "root";
                $dbPassword = "password";
                $dbName = "pa_database";
                $dbPrefix = "mnga_";

                $data["WEBSITE_NAME"] = htmlspecialchars($_POST["WEBSITE_NAME"]);
                $data["WEBSITE_CONTACT_ADDRESS"] = htmlspecialchars($_POST["WEBSITE_CONTACT_ADDRESS"]);
                $data["WEBSITE_ADMIN"] = htmlspecialchars($_POST["WEBSITE_ADMIN"]);
                $data["WEBSITE_PASSWORD"] = htmlspecialchars($_POST["WEBSITE_PASSWORD"]);
                $data["DB_HOST"] = $dbHost;
                $data["DB_DRIVER"] = $dbDriver;
                $data["DB_PORT"] = $dbPort;
                $data["DB_NAME"] = $dbName;
                $data["DB_PREFIXE"] = $dbPrefix;
                $data["DB_USER"] = $dbUser;
                $data["DB_PASSWORD"] = $dbPassword;
                $data["EMAIL_SOURCE_NAME"] = htmlspecialchars($_POST["EMAIL_SOURCE_NAME"]);
                $data["EMAIL_SMTP_HOST"] = htmlspecialchars($_POST["EMAIL_SMTP_HOST"]);
                $data["EMAIL_SMTP_ADMIN"] = htmlspecialchars($_POST["EMAIL_SMTP_ADMIN"]);
                $data["EMAIL_SMTP_PASSWORD"] = htmlspecialchars($_POST["EMAIL_SMTP_PASSWORD"]);
                $data["EMAIL_SMTP_PORT"] = htmlspecialchars($_POST["EMAIL_SMTP_PORT"]);
                $install = Install::execute($data);

                $data["DB_NAME"] = htmlspecialchars($_POST["DB_NAME"]);
                $data["DB_PREFIXE"] = htmlspecialchars($_POST["DB_PREFIXE"]);

                return $data;

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
        $config = 'define("DB_HOST","' . $data["DB_HOST"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_DRIVER","' . $data["DB_DRIVER"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PORT","' . $data["DB_PORT"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_NAME","' . $data["DB_NAME"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PREFIXE","' . $data["DB_PREFIXE"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_USER","' . $data["DB_USER"] . '");';
        fwrite($configFile, $config);
        fwrite($configFile, "\n");
        $config = 'define("DB_PASSWORD","' . $data["DB_PASSWORD"]  . '");';
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

    public static function createDatabaseAndTable($data)
    {
        $userModel = new UserModel();
        $userModel->createDatabase($data["DB_NAME"]);

        Install::execute($data);

        $connection_pdo = new \PDO(DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".$data["DB_NAME"] , DB_USER , DB_PASSWORD
            , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);



        //MIGRATION CREATE TABLE event
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."event` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `name` varchar(50) NOT NULL,
              `description` varchar(320) NOT NULL,
              `price` int(11) NOT NULL,
              `date` timestamp NULL DEFAULT NULL,
              `photo` varchar(255) NOT NULL,
              `createdAt` timestamp NULL DEFAULT NULL,
              `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE forumcommentaire
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."forumcommentaire` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `id_forum` int(11) NOT NULL,
              `id_user` int(11) NOT NULL,
              `commentaire` text,
              `isValid` tinyint(1) DEFAULT '0',
              `createdAt` timestamp NULL DEFAULT NULL,
              `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE manga
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."manga` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `type` varchar(10) NOT NULL,
              `title` varchar(255) NOT NULL,
              `description` varchar(400) NOT NULL,
              `image` varchar(100) NOT NULL,
              `release_date` date NOT NULL,
              `author` varchar(50) NOT NULL,
              `status` varchar(20) NOT NULL,
              `category` varchar(20) NOT NULL,
              `nb_tomes` int(11) NOT NULL,
              `nb_chapters` int(11) NOT NULL,
              `nb_episodes` int(11) NOT NULL,
              `diffusion` varchar(100) NOT NULL,
              `nb_seasons` int(11) NOT NULL,
              `production_studio` varchar(50) NOT NULL,
              `createdAt` timestamp NULL DEFAULT NULL,
              `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE newsletter
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."newsletter` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `id_user` int(11) NOT NULL,
              `id_subject` int(11) NOT NULL,
              `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE page
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."page` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `title` varchar(100) NOT NULL,
              `description` text,
              `page` varchar(50) NOT NULL,
              `user_id` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE role
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."role` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `role` varchar(50) DEFAULT 'abonnÃ©',
              `createdAt` timestamp NULL DEFAULT NULL,
              `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();

        //MIGRATION CREATE TABLE user
        $q = "CREATE TABLE `".$data["DB_PREFIXE"]."user` (
              `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
              `firstname` varchar(25) NOT NULL,
              `lastname` varchar(100) NOT NULL,
              `email` varchar(320) NOT NULL,
              `status` tinyint(4) NOT NULL,
              `password` varchar(255) NOT NULL,
              `token` char(255) DEFAULT NULL,
              `avatar` varchar(255) NOT NULL,
              `gender` varchar(1) NOT NULL,
              `role` int(1) NOT NULL,
              `pays` varchar(50) NOT NULL,
              `ville` varchar(100) NOT NULL,
              `createdAt` timestamp NULL DEFAULT NULL,
              `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $stmt= $connection_pdo->prepare($q);
        $stmt->execute();


    }

    public static function createUserAdmin($admin, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        UserRepository::createUserAdmin($admin, $password);
    }
}
