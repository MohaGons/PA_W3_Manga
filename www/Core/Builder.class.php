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
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<select name='" . $name . "'
                     id='" . $configInput["id"] . "'";
                    if (($configInput["disabled"]) == true) {
                        $html .= " disabled";
                    }
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "><option value='" . $option . "'";
                        if ($option == $configInput["defaultValue"]) {
                            $html .= " selected='selected'";
                        }
                        $html .= ">$value</option><br>";
                    }
                    $html .= "</select><br>";
                    
                    break;
                case "radio":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div><label for='" . $name . "'>";
                        $html .= $value["label"];
                        $html .= "</label>";
                        $html .= "<input type='" . $configInput["type"] . "' class='" . $value["class"] . "' id='" . $value["id"] . "'
                            name='" . $name . "'
                            value='" . $value["value"] . "'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "></div><br>";
                    }

                    break;
                case "checkbox":
                    foreach ($configInput["option"] as $option => $value) {
                        $html .= "<div><label for='" . $name . "'>" . $value["label"] . "</label></div>";
                        $html .= "<input type='" . $configInput["type"] . "'
                                class='" . $value["class"] . "'
                                id='" . $value["id"] . "'
                                name='" . $name . "'
                                value='" . $value["value"] . "'";
                        if ($value["id"] === $configInput["defaultValue"]) {
                            $html .= " checked";
                        }
                        $html .= "></div><br>";
                    }
                    break;
                case "textarea":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<textarea id='" . $configInput["id"] . "'
                                class='" . $configInput["class"] . "'
                                name='" . $name . "'
                                rows='" . $configInput["rows"] . "'
                                cols='" . $configInput["cols"] . "'>" . $configInput["text"] . "</textarea><br>";

                    break;
                case "file":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<div><input type='" . $configInput["type"] . "'
                                class='" . $configInput["class"] . "'
                                id='" . $configInput["id"] . "'
                                name='" . $name . "'
                                accept='" . $configInput["accept"] . "'></div><br>";
                    break;
                case "hidden":
                    $html .= "<div><input type='" . $configInput["type"] . "'
                                name='" . $name . "'
                                value='" . $configInput["value"] . "'></div><br>";
                    break;
                case "text":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            value='".$configInput["value"]."'
                            minlength='".$configInput["minlength"]."'
                            maxlength='".$configInput["maxlength"]."'
                            ><br>";
                    break;
                case "number":
                    $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<input type='".$configInput["type"]."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            name='" . $name . "'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            value='".$configInput["value"]."'
                            ><br>";
                    break;
                case "email":
                    $html .= "<div class='form-field'><label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            ></div><br>";
                    break;
                case "password":
                    $html .= "<div class='form-field'><label for='" . $name . "'>" . $configInput["label"] . "</label>";
                    $html .= "<input name='".$name."'
                            class='".$configInput["class"]."'
                            id='".$configInput["id"]."'
                            placeholder='".$configInput["placeholder"]."'
                            type='".$configInput["type"]."'
                            ></div><br>";
                    break;
                default:
                $html .= "<label for='" . $name . "'>" . $configInput["label"] . "</label>";
                $html .= "<input name='".$name."'
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
