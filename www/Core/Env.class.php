<?php

namespace App\Core;

class Env
{
    public static function getEnvData($envFile)
    {
        $file = fopen($envFile, "r");
        $regex = "/([^=]*)=([^#]*)/";

        $data = [];

        if (!empty($file)) {
            while (!feof($file)) {
                $line = fgets($file);
                preg_match($regex, $line, $results);
                if (!empty($results[1]) && !empty($results[2]))
                    $data[mb_strtoupper($results[1])] = trim($results[2]);
            }
        }

        return $data;
    }

    public static function writeConfData($data, $envFile)
    {
        $dataString = "";
        foreach ($data as $key => $value) {
            $dataString .= $key . "=" . $value . PHP_EOL;
        }
        file_put_contents($envFile, $dataString);
    }

    public static function updateGeneralEnv($data)
    {
        $data['ENV'] = ENV;
        Env::writeEnvData($data, ".env");
    }

    public static function updateDatabaseEnv($data)
    {
        $data['DB_DRIVER'] = DB_DRIVER;
        $data['DB_PORT'] = DB_PORT;
        $data['DB_PREFIXE'] = DB_PREFIXE;
        Env::writeEnvData($data, ".env.db");
    }

    public static function updateMailingEnv($data)
    {
        Env::writeEnvData($data, ".env.smtp");
    }
}
