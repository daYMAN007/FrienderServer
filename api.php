<?php
require_once 'libary.php'; //todo pw dont work at all
$action = $_POST['action'];

switch ($action){
      case "Registrieren":
      $BenPasswort=hashpw($_POST['BenPasswort']);
      $Benutzername=$_POST['Benutzername'];
      $BenVorname=$_POST['BenVorname'];
      $BenNachname=$_POST['BenNachname'];
      $BenTelefonnummer=$_POST['BenTelefonnummer'];
      $BenLongitude=$_POST['BenLongitude'];
      $BenLatitude=$_POST['BenLatitude'];
      $BenGeoTime=$_POST['BenGeoTime'];
      Registrieren($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort);
      break;

      case "Login":
      $user= getUser($_POST['Benutzername']);
      if($user==null)
      {
        echo "User nicht gefunden";
      }
      else if(login($user,$_POST['BenPasswort']))
      {
        echo "Login erfolgreich";
      }
      else {
        echo "Falsches PW";
      }
      break;
}
