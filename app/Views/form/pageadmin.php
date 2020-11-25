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
        <?php
        App\Controllers\Session::verifySession();
        echo("Bonjour ".App\Controllers\Session::getSessionData('nom'));
        echo anchor('Connexion/deconnexion', 'Déconnexion');
        ?>
    </body>
</html>
