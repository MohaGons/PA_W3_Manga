<?php

namespace App\Core;

use App\Core\Session as Session;
use App\Core\View as View;
use App\Core\Env as Env;
use App\Core\Security;

class Install
{
    //il va verifier s'il y a un point .env
    //dans point .env il faut
    //define("DBDRIVER", "mysql");
    //define("DBUSER", "root");
    //define("DBPWD", "password");
    //define("DBHOST", "database");
    //define("DBNAME", "pa_database");
    //define("DBPORT", "3306");
    //define("DBPREFIXE", "mnga_");
    //EMAIL_SOURCE_NAME=
    //EMAIL_SOURCE_ADDRESS=
    //EMAIL_SMTP_HOST=
    //EMAIL_SMTP_ADMIN=
    //EMAIL_SMTP_PASSWORD=
    //EMAIL_SMTP_PORT=
    //
    //
    //
    //
    //
    public static function check(): bool
    {
        $fileName = ".env";
        if (!file_exists($fileName))
            return false;

        $file = fopen($fileName, 'r');
        $envPattern = "/([^=]*)=([^#]*)/";
        $envPairs = [];

        while (!feof($file)) {
            $line = fgets($file);
            preg_match($envPattern, $line, $results);
            if (!empty($results[1]) && !empty($results[2]))
                $envPairs[mb_strtoupper($results[1])] = trim($results[2]);
        }

        if (!isset($envPairs['WEBSITE_NAME']))
            return false;
        return true;
    }

    public static function start()
    {
        Session::destroy();
        $install = Install::formBuilderInstall();
        $errors = [];


        if (!empty($_POST)) {
            $result = Verificator::checkForm(Install::formBuilderInstall(), $_POST);

            $data = [];
            if (empty($result)) {
                $data["WEBSITE_NAME"] = htmlspecialchars($_POST["WEBSITE_NAME"]);
                $data["WEBSITE_CONTACT_ADDRESS"] = htmlspecialchars($_POST["WEBSITE_CONTACT_ADDRESS"]);
                $data["WEBSITE_ADMIN"] = htmlspecialchars($_POST["WEBSITE_ADMIN"]);
                $data["WEBSITE_PASSWORD"] = htmlspecialchars($_POST["WEBSITE_PASSWORD"]);
                $data["DB_HOST"] = htmlspecialchars($_POST["DB_HOST"]);
                $data["DB_NAME"] = htmlspecialchars($_POST["DB_NAME"]);
                $data["DB_USER"] = htmlspecialchars($_POST["DB_USER"]);
                $data["DB_PASSWORD"] = htmlspecialchars($_POST["DB_PASSWORD"]);
                $data["EMAIL_SOURCE_NAME"] = htmlspecialchars($_POST["EMAIL_SOURCE_NAME"]);
                $data["EMAIL_SMTP_HOST"] = htmlspecialchars($_POST["EMAIL_SMTP_HOST"]);
                $data["EMAIL_SMTP_ADMIN"] = htmlspecialchars($_POST["EMAIL_SMTP_ADMIN"]);
                $data["EMAIL_SMTP_PASSWORD"] = htmlspecialchars($_POST["EMAIL_SMTP_PASSWORD"]);
                $data["EMAIL_SMTP_PORT"] = htmlspecialchars($_POST["EMAIL_SMTP_PORT"]);
                $errors = Install::execute($data);

                if (empty($errors)) {
                    Install::migrate();
                }

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
                    "required"=>true,
                    "value" => "Admintest_12345"
                ],

                "DB_HOST" => [
                    "id" => "dbHostInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Serveur de base de données : ",
                    "placeholder" => "Votre serveur de base de données",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "database"
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
                    "value" => "pa_database"
                ],
                "DB_USER" => [
                    "id" => "dbUserInstall",
                    "type" => "text",
                    'class' => 'formRegister',
                    "label" => "Utilisateur : ",
                    "placeholder" => "Nom de l'utilisateur de la base de données",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "root"
                ],
                "DB_PASSWORD" => [
                    "id" => "dbPasswordInstall",
                    "type" => "password",
                    'class' => 'formRegister',
                    "label" => "Mot de passe : ",
                    "placeholder" => "Mot de passe de l'utilisateur ci-dessus",
                    "minlength"=>"",
                    "maxlength"=>"",
                    "required"=>true,
                    "value" => "password"
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
        $defaultEnv = [
            'WEBSITE_NAME' => $data['WEBSITE_NAME'],
            'WEBSITE_CONTACT_ADDRESS' => $data['WEBSITE_CONTACT_ADDRESS'],
            'ENV' => 'prod'
        ];

        $databaseEnv = [
            'DB_HOST' => $data['DB_HOST'],
            'DB_DRIVER' => "mysql",
            'DB_PORT' => 3306,
            'DB_NAME' => $data['DB_NAME'],
            'DB_PREFIXE' => "faman_",
            'DB_USER' => $data['DB_USER'],
            'DB_PASSWORD' => $data['DB_PASSWORD']
        ];

        $mailingEnv = [
            "EMAIL_SOURCE_NAME" => $data['EMAIL_SOURCE_NAME'],
            "EMAIL_SMTP_HOST" => $data['EMAIL_SMTP_HOST'],
            "EMAIL_SMTP_ADMIN" => $data['EMAIL_SMTP_ADMIN'],
            "EMAIL_SMTP_PASSWORD" => $data['EMAIL_SMTP_PASSWORD'],
            "EMAIL_SMTP_PORT" => $data['EMAIL_SMTP_PORT']
        ];

        $defaultEnvFile = "conf.inc.php";

        Env::writeEnvData($defaultEnv, $defaultEnvFile);
        Env::writeEnvData($databaseEnv, $defaultEnvFile);
        Env::writeEnvData($mailingEnv, $defaultEnvFile);

        $envFiles = [$defaultEnvFile, $defaultEnvFile, $defaultEnvFile];
        foreach ($envFiles as $file) {
            if (!file_exists($file)) {
                die("Erreur ENV-W001");
            }
        }

        $_SESSION["WIZARD_ADMIN_CREDENTIALS"] = [
            'email' => $data["WEBSITE_ADMIN"],
            'password' => $data["WEBSITE_PASSWORD"],
        ];

        return [];
    }

    public static function migrate()
    {
//        var_dump(DB_HOST);
        die("vuybijnkl");
    }
}
