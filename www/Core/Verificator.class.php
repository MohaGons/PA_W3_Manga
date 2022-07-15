<?php

namespace App\Core;

use App\Core\Session as Session;
use App\Model\User as UserModel;

class Verificator
{

    public static function checkFormRegister($config, $data): array
    {
        $errors = [];

        /*
        if( count($config["inputs"]) != count($_POST)){
            die("Tentative de hack");
        }
        */
        
        foreach ($config["inputs"] as $name=>$input)
        {
            if(!empty($input["required"]) && $input["required"] == true && empty($data[$name])){
                $errors[]= $name ." ne peut pas être vide";
            }

            if(!empty($input["min"]) && strlen($data[$name]) < $input["min"]){
                $errors[]= $input["error"];
            }

            if(!empty($input["max"]) && strlen($data[$name]) > $input["max"]){
                $errors[]= $input["error"];
            }

            if($input["type"]=="email" &&  !self::checkEmail($data[$name])) {
                $errors[]=$input["error"];
            }

            if($input["type"]=="password" &&  !self::checkPwd($data[$name]) && empty($input["confirm"])) {
                $errors[]=$input["error"];
            }

            if( !empty($input["confirm"]) && $data[$name]!=$data[$input["confirm"]]  ){
                $errors[]=$input["error"];
            }
        }

        return $errors;
    }

    public static function checkFormLogin($config, $data): array
    {
        $errors = [];

        echo "<pre>";
        var_dump($config["inputs"]);

        if( count($config["inputs"]) != count($_POST)){
            die("Tentative de hack");
        }

        foreach ($config["inputs"] as $name=>$input)
        {
            if(!empty($input["required"]) && $input["required"] == true && empty($data[$name])){
                $errors[]= $name ." ne peut pas être vide";
            }
        }

        return $errors;
    }

    public static function checkFormParam($config, $data): array
    {
        echo "<pre>";
        var_dump($config);
        var_dump($data);

        $errors = [];
        foreach ($config["inputs"] as $name=>$input) {
            if (!empty($data[$name])){

                if ($input["required"] == true) {

                    switch ($input["type"]) {
                        case "text":
                            var_dump($input["min"]);
                            var_dump(strlen($data[$name]));
                        break;
                        default:
                            var_dump("ok");
                        break;
                    }
                    var_dump("obligatoite mec");
                }
                else {
                    var_dump("pas obligatoite mec");
                }
//                var_dump($name);
//                var_dump($input["min"]);
//                var_dump(strlen($data[$name]));
//                var_dump($data[$name]);
                if (!empty($input["min"]) && strlen($data[$name]) < $input["min"]) {
                    var_dump("tyu");
                    $errors[] = $input["error"];
                }
                if (!empty($input["max"]) && strlen($data[$name]) > $input["max"]) {
                    $errors[] = $input["error"];
                }
                if($input["type"]=="email" &&  !self::checkEmail($data[$name])) {
                    $errors[]=$input["error"];
                }
            }
        }
        die();
        return $errors;
    }


    public static function checkupdateUser($config, $data): array
    {
        $errors = [];
        foreach ($config["inputs"] as $name=>$input) {
            if (!empty($data[$name])){
                if (!empty($input["min"]) && strlen($data[$name]) < $input["min"]) {
                    $errors[] = $input["error"];
                }
                if (!empty($input["max"]) && strlen($data[$name]) > $input["max"]) {
                    $errors[] = $input["error"];
                }
            }
        }

        return $errors;
    }

    public static function checkGeneralForm($config, $data): array
    {
        $errors = [];

        /*
        if( count($config["inputs"]) != count($_POST)){
            die("Tentative de hack");
        }
        */
        
        foreach ($config["inputs"] as $name=>$input)
        {

            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== Session::get('token')) {
                $errors[]= "Tentative CSRF !";
            }

            if(!empty($input["required"]) && $input["required"] == true && empty($data[$name])){
                $errors[]= $name ." ne peut pas être vide";
            }

            if(!empty($input["min"]) && strlen($data[$name]) < $input["min"]){
                $errors[]= $input["error"];
            }

            if(!empty($input["max"]) && strlen($data[$name]) > $input["max"]){
                $errors[]= $input["error"];
            }

            if($input["type"]=="email" &&  !self::checkEmail($data[$name])) {
                $errors[]=$input["error"];
            }

            if($input["type"]=="password" &&  !self::checkPwd($data[$name]) && empty($input["confirm"])) {
                $errors[]=$input["error"];
            }

            if( !empty($input["confirm"]) && $data[$name]!=$data[$input["confirm"]]  ){
                $errors[]=$input["error"];
            }
        }

        return $errors;
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkPwd($pwd): bool
    {
        return strlen($pwd)>=8
            && preg_match("/[0-9]/",$pwd, $result )
            && preg_match("/[A-Z]/",$pwd, $result );
    }
    public static function checkEventFormRegister($config, $data): array
    {
        $errors = [];

        if (count($config["inputs"]) != count($_POST)) {
            die("Tentative de hack");
        }


        foreach ($config["inputs"] as $name => $input) {
            if (!empty($input["required"]) && $input["required"] == true && empty($data[$name])) {
                $errors[] = $name . " ne peut pas être vide";
            }

            if (!empty($input["min"]) && strlen($data[$name]) < $input["min"]) {
                $errors[] = $input["error"];
            }

            if (!empty($input["max"]) && strlen($data[$name]) > $input["max"]) {
                $errors[] = $input["error"];
            }

            if ($input["type"] == "date" &&  !self::checkDate($data[$name])) {
                $errors[] = $input["error"];
            }

            if (!empty($input["confirm"]) && $data[$name] != $data[$input["confirm"]]) {
                $errors[] = $input["error"];
            }
        }


        return $errors;
    }


    public static function checkDate($date): bool
    {
        if (strtotime($date) > strtotime('now')) {
            return true;
        } else {
            return false;
        }
    }
}
