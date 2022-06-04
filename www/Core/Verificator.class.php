<?php

namespace App\Core;

use App\Model\User as UserModel;


class Verificator
{

    public static function checkFormRegister($config, $data): array
    {
        $errors = [];

        if( count($config["inputs"]) != count($_POST)){
            die("Tentative de hack");
        }

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

    public static function checkFormParam($config, $data): array
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
                if($input["type"]=="email" &&  !self::checkEmail($data[$name])) {
                    $errors[]=$input["error"];
                }
            }
        }
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
}