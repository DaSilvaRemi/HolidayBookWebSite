<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Gestion de réservations</title>
    </head>
    <body>

        <div class="container">
            <div class="row">

                <H1>Gestion de réservations</H1>
            </div>
            <div class="row">
                <table class="table table-bordered table-hover">
                    <tr class="thead-light" >
                        <th scope="col">Nom / Prenom</th>
                        <th scope="col">Login</th>
                        <th scope="col">Action</th>

                    </tr>

                    <?php
                    if (isset($tabUtilisateurs)) {
                        foreach ($tabUtilisateurs as $LesUtilisateurs) {
                            if (isset($LesUtilisateurs['id_user'])) {
                                echo "<tr scope='row'>";
                                echo "<td>" . $LesUtilisateurs['nom'] . " - " . $LesUtilisateurs['prenom'] . "</td>";
                                echo "<td>" . $LesUtilisateurs['login'] . "</td>";
                                echo "<td>";
                                echo form_open('GestionUser');
                                echo anchor('AddUserAdmin', '<button class="btn btn-warning fa fa-pencil-square-o"/>');
                                echo "</form>";

                                echo form_open('GestionUser');
                                echo '<input name="idUtilisateur" type="hidden" value="' . $LesUtilisateurs['id_user'] . '"/>';
                                echo form_button(array('nom' => 'supprimerUser', 'type' => 'submit', 'class' => 'btn btn-danger', 'content' => '<i class="fa fa-trash"></i>'));
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo 'Erreur : Champs Vide !!!';
                    }
                    ?>     
                </table>
                <?php echo anchor('AddUserAdmin', '<input class="btn btn-success btn-block fa fa-user" value="Ajouter un utilisateur test"/>'); ?>
            </div>
    </body>
</html>
