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
                    $html = "<select name='" . $name . "'
                     id='" . $configInput["id"] . "'>";
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<option value='" . $option . "'";
                        if ($option === $configInput["defaultValue"]) {
                            $html .= " selected";
                        }
                        $html .= ">$value</option>";
                    }
                case "radio":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div class='" . $value["class"] . "' id='" . $value["id"] . "'
                            name='" . $name . "'
                            value='" . $value["value"] . "'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "><br>";
                        $html .= "<label for='" . $name . "'>";
                        $html .= $value["label"];
                        $html .= "</label></div>";
                    }

                    break;
                case "checkbox":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div><input type='" . $configInput["type"] . "'
                                class='" . $value["class"] . "'
                                id='" . $value["id"] . "'
                                name='" . $name . "'
                                value='" . $value["value"] . "'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "><br>";
                        $html .= "<label for='" . $name . "'>" . $value["label"] . "</label></div>";
                    }
                    break;
                case "textarea":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<textarea id='" . $configInput["id"] . "'
                                class='" . $configInput["class"] . "'
                                name='" . $name . "'
                                rows='" . $configInput["rows"] . "'
                                cols='" . $configInput["cols"] . "'> </textarea><br>";

                    break;
                case "file":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<div><input type='" . $configInput["type"] . "'
                                class='" . $configInput["class"] . "'
                                id='" . $configInput["id"] . "'
                                name='" . $name . "'
                                accept='" . $configInput["accept"] . "'></div><br>";
                    break;
                case "text":
                    $html = "<input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            value='".$configInput["value"]."'
                            ><br>";
                    break;
                case "email":
                    $html = "<div class='form-field'><input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            ></div><br>";
                    break;
                case "password":
                    $html = "<div class='form-field'><input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            ></div><br>";
                    break;
                case "submit":
                    $html = "<button type='".$configInput["type"]."' class='".$configInput["class"]."'><p>".$configInput["title"]."</p></button><br>";
                    break;
                default:
                    $html = "<input name='" . $name . "'
                            class='" . $configInput["class"] . "'
                            id='" . $configInput["id"] . "'
                            placeholder='" . $configInput["placeholder"] . "'
                            type='" . $configInput["type"] . "'
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
