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
      $user = getUser($myData['Benutzername']);
      if($user == null)
      {
        Registrieren($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenPasswort);
        $user= getUser($Benutzername);
        echo "0;".$user['BenutzerId'];
      }
      else if($BenVorname != null || $BenNachname !=  null || $BenTelefonnummer != null || $BenPasswort != null)
      {
        echo "1";
      }
      else {

          echo "unkown error";
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
        echo "1;".$user['BenutzerId'];

      }
      else {
        echo "2";
      }
      break;

      case "DataList": //liste für sidebar auslesen
      $BenutzerId = ($myData['BenutzerId']);
      $sql = "SELECT BenutzerId, BenVorname, BenNachname, BenTelefonnummer, BenLongitude, BenLatitude, BenGeoTime FROM tbenutzer where BenutzerId != $BenutzerId;";
       echo isOnlineDatenAuslesen($BenutzerId, $sql);

      break;

      case "UpdateEinstellungen": //Einstellungs Daten auslesen
     $BenutzerId = ($myData['BenutzerId']);
     $sql = "SELECT BenutzerId, BenNickname, BenVorname, BenNachname, BenTelefonnummer FROM tbenutzer where BenutzerId = $BenutzerId;";
      echo DatenAuslesen($BenutzerId, $sql);
     break;

      case "SaveGeoData":
      $user= getUser($myData['Benutzername']);
      if($user==null)
      {
        echo "0";
      }
      else if(login($user,$myData['BenPasswort']))
      {
        PositionUpdate($user['BenutzerId'],$myData['BenLongitude'],$myData['BenLatitude']);
      }
      else {
        echo "2";
      }
      break;

      case "Updaten":
      $BenPasswort=hashpw($myData['BenPasswort']);
      $Benutzername=$myData['Benutzername'];
      $BenVorname=$myData['BenVorname'];
      $BenNachname=$myData['BenNachname'];
      $BenTelefonnummer=$myData['BenTelefonnummer'];
      $BenutzerId = ($myData['BenutzerId']);
        Userupdate($BenutzerId,$Benutzername,$BenPasswort,$BenTelefonnummer,$BenVorname,$BenNachname);
      break;

}
