<?php
require_once 'libary.php'; //todo pw dont work at all
$myData = json_decode($_POST['myData'],true);
$action = $myData['action'];
//Überprüfen, ob die eingegebenen Daten richtig sind
switch ($action){
      case "Registrieren":
      $BenPasswort=hashpw($myData['BenPasswort']);
      $Benutzername=$myData['Benutzername'];
      $BenVorname=$myData['BenVorname'];
      $BenNachname=$myData['BenNachname'];
      $BenTelefonnummer=$myData['BenTelefonnummer'];
      Registrieren($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenPasswort);
      $user = getUser($myData['Benutzername']);
      if($user == null)
      {
        echo "0";
      }
      else if($BenVorname == null || $BenNachname ==  null || $BenTelefonnummer == null || $BenPasswort == null)
      {
        echo "1";
      }
      else {
        echo "2";
      }
      break;

      case "Login":
      $user= getUser($myData['Benutzername']);
      if($user==null)
      {
        echo "0";
      }
      else if(login($user,$myData['BenPasswort']))
      {
        echo "1";
      }
      else {
        echo "2";
      }
      break;

      case "DatenAuslesen":
      DatenAuslesen();
      if ($userarr == null)
      {
        echo "0";
      }
      else {
        echo "1";
      }
}
