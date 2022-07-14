<?php

namespace App\Controller;
use App\Core\View;
use App\Model\Event as EventModel;
use App\Core\Mailer;


class Frontevent
{
   public function FrontEvent(){

       $messages=[];
       require ('stripe-php-master/init.php');
       $publishableKey = "pk_test_51LKIrYEf8Ik7LivPyKhufvmPYSZGwb9Wfw7jtnvLt9jNmuqKk8bGTkVvJJbrrl0qhazSdbEq4MzIMZg9v4ghazTj00WzYPHeJ0";
       $secretKey = "sk_test_51LKIrYEf8Ik7LivPzY3Q4zgCa8izsmDcmrSL3BXRB6gpmobJF2iaJbSAsLIevWrGAtaVLP1sGE77jPK7ekEOlk3h003xbcjRAr";
       \Stripe\Stripe::setApiKey($secretKey);
       if(isset($_POST['stripeToken'])){
           \Stripe\Stripe::setVerifySslCerts(false);

           $token=$_POST['stripeToken'];

           $data=\Stripe\Charge::create(array(
               "amount"=>$_POST['prix']*100,
               "currency"=>"eur",
               "description"=>"Paiement Evenement Manga",
               "source"=>$token,
           ));
           $messages[]="votre reservation a bien ete prise en compte, vous receverez par email la une confirmation de paiement";
           $destinataire = 'aminecheriguifr@gmail.com';
           $name = "";
           $lastname="";
           $subject = 'Reservation MangaSite';
           $body = 'votre reservation a bien ete prise en compte sur MangaSite';
           Mailer::sendMail($destinataire, $name, $lastname, $subject, $body);

       }

       $event = new EventModel();
       $view = new View("front-event");
       $view->assign("publishableKey", $publishableKey);
       $event = $event->getEvents();
       $view->assign("event_data", $event);
       if(isset($messages)){
           $view->assign("messages", $messages);
       }
   }
}