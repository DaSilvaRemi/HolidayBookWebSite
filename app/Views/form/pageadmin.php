<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?= form_open('CreateUser'); ?>
        <table>
        <?php
        foreach ($tabReservation as $LesReservations) {
            echo('<tr><td><h3>Mr/Mme'.$Lesreservations['nom'].'</h3></td>');                        //Collone Nom  
            echo('<td><h3>Debut de la reservation : '.$Lesreservations['datedebut'].'</h3></td>');  //Collone Date
            echo('<td><h3>Nb de personnes : '.$Lesreservations['nbpersonne'].'</h3></td>');         //Collone Nb de personnes
            
            echo('<td>');                   //Si la reservation est déjà validée, le radio n'apparait pas
            if ($LesReservations['valide'] == false){
                echo('<input type="radio" name="Selection" value="'.$LesReservations['id_reservation'].'">');
            } else {
                echo('<h3>Validée</h3>');
            }
            echo('</td>');
            
        }
            App\Controllers\Session::verifySession();
            echo("Bonjour ".App\Controllers\Session::getSessionData('nom'));
            echo anchor('Connexion/deconnexion', 'Déconnexion');
        ?>
        </table>
        </form>
    </body>
</html>
