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
        <form>
        <table>
        <?php
        foreach ($tabQueryReservations as $LesReservations) {
            echo('<tr><td><h3>Mr/Mme'.$Lesreservations['nom'].'</h3></td>');
            echo('<td><h3>Debut de la reservation : '.$Lesreservations['datedebut'].'</h3></td>');
            
            echo('<td><input type="radio" name="Selection" value="'.$LesReservations['id_reservation'].'"></tr>');
        }
            App\Controllers\Session::verifySession();
            echo("Bonjour ".App\Controllers\Session::getSessionData('nom'));
            echo anchor('Connexion/deconnexion', 'Déconnexion');
        ?>
        </table>
        </form>
    </body>
</html>
