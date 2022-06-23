<?php

namespace App\Core;

class Builder
{

    public static function render($config)
    {

        foreach ($config["inputs"] as $name => $configInput) {

            $html = "";
            switch ($configInput["type"]) {
                case "select":
                    $html = "<select name='".$name."'
                     id='".$configInput["id"]."'>";
                     foreach ($configInput["option"] as $option => $value) {
                        $html .= "<option value='".$option."'";
                         if ($option === $configInput["defaultValue"]) {
                             $html .= " selected";
                         }
                        $html .= ">$value</option>";

                     }
                     $html .= "</select><br>";
                    break;
                case "radio":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div>";
                        $html .= "<input type='".$configInput["type"]."'
                            class='".$value["class"]."'
                            id='".$value["id"]."'
                            name='".$name."'
                            value='".$value["value"]."'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "><br>";
                        $html .= "<label for='".$name."'>";
                        $html .= $value["label"];
                        $html .= "</label></div>";
                    }

                    break;
                case "checkbox":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div><input type='".$configInput["type"]."'
                                class='".$value["class"]."'
                                id='".$value["id"]."'
                                name='".$name."'
                                value='".$value["value"]."'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "><br>";
                        $html .= "<label for='".$name."'>".$value["label"]."</label></div>";
                }
                    break;
                case "textarea":
                    $html .= "<label for='".$name."'>".$configInput["label"]."</label>";
                    $html .= "<textarea id='".$configInput["id"]."'
                                class='".$configInput["class"]."'
                                name='".$name."'
                                rows='".$configInput["rows"]."'
                                cols='".$configInput["cols"]."'>".$configInput["text"]."</textarea><br>";

                    break;
                case "file":
                    $html .= "<label for='".$name."'>".$configInput["label"]."</label>";
                    $html .= "<div><input type='".$configInput["type"]."'
                                class='".$configInput["class"]."'
                                id='".$configInput["id"]."'
                                name='".$name."'
                                accept='".$configInput["accept"]."'></div><br>";
                    break;
                default:
                    $html = "<input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                           
                            ><br>";
                    break;

            }

            echo $html;

        }

    }

    /*
    public static function captcha() {
        $html = '<form action="validate.php" method="post">
                    <table>
                        <tr>
                            <td>
                                <label>Entrer le texte dans l\'image</label>
                                <input name="captcha" type="text">
                                <img src="captcha.php" style="vertical-align: middle;"/>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="submit" type="submit" value="Submit"></td>
                        </tr>
                    </table>
                </form>';

        echo $html;

    }
    */

}
