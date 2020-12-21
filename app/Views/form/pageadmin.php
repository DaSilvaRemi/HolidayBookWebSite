<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gestion de réservations</title>
    </head>
    <body>
        <?= form_open('PageAdmin'); ?>
        <div class="container">
            <div class="row">
                
                <H1>Gestion de réservations</H1>
            </div>
            <div class="row">
                  <?= form_open('PageAdmin'); ?>
                <table class="table">
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Date début</th>
                    <th scope="col">Nombre de personnes</th>
                    <th scope="col">Pension</th>
                    <th scope="col">Etat de la réservation</th>
                    <th scope="col">Annuler</th>
                    </tr>
                    
                    <?php
                    if(isset($tabReservation)){
                        foreach ($tabReservation as $LesReservations) {
                            echo "<tr scope='row'>";
                            echo "<td>".$LesReservations['nom']."</td>";
                            echo "<td>".$LesReservations['datedebut']."</td>";                        
                            echo "<td>".$LesReservations['nbpersonne']."</td>";
                            echo "<td>".$LesReservations['pension']."</td>";
                            echo "<td>".$LesReservations['valide']."</td>";
                            echo "<td>";
                            echo form_button(array('name'=>'modifier','type'=>'submit','class'=>'btn btn-warning', 'content'=>'<i class="fa fa-pencil-square-o"></i>'));
                            echo form_button(array('nom'=>'refuser','type'=>'submit','class'=>'btn btn-danger', 'content'=>'<i class="fa fa-trash"></i>'));
                            echo "</td>";
                            echo "</tr>";
                        }  
                    }
                    else {
                        echo 'Erreur : Champs Vide !!!';
                    }
                ?>     
                </table>
            </div>
    </body>
</html>
