<?php

namespace App\Controller;
use App\Core\View;

class stripe
{

    public function stripe($prix)
    {
        require ('stripe-php-master/init.php');
        $publishableKey = "pk_test_51LKIrYEf8Ik7LivPyKhufvmPYSZGwb9Wfw7jtnvLt9jNmuqKk8bGTkVvJJbrrl0qhazSdbEq4MzIMZg9v4ghazTj00WzYPHeJ0";
        $secretKey = "sk_test_51LKIrYEf8Ik7LivPzY3Q4zgCa8izsmDcmrSL3BXRB6gpmobJF2iaJbSAsLIevWrGAtaVLP1sGE77jPK7ekEOlk3h003xbcjRAr";
        \Stripe\Stripe::setApiKey($secretKey);
        if(isset($_POST['stripeToken'])){
            \Stripe\Stripe::setVerifySslCerts(false);

            $token=$_POST['stripeToken'];

            $data=\Stripe\Charge::create(array(
                "amount"=>$prix,
                "currency"=>"eur",
                "description"=>"Paiement Evenement Manga",
                "source"=>$token,
            ));
        }
        $view = new View("stripe");
        $view->assign("publishableKey", $publishableKey);
    }

}