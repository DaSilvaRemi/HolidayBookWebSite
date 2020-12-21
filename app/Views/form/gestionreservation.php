<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<?= form_open('GestionReservation'); ?>
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
                <table class="table">
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Date début</th>
                    <th scope="col">Nombre de personnes</th>
                    <th scope="col">Pension</th>
                    <th scope="col">Etat de la réservation</th>
                    <th scope="col">Actions</th>
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
                            //Si la réservation est en attente ou modifiée on peut alors la validée
                            if($LesReservations['valide'] == "En attente de validation" || $LesReservations['valide'] == "Modifiée"){
                                echo form_open('GestionReservation');
                                echo '<input name="idReservationValide" type="hidden" value="'.$LesReservations['id_reservation'].'"/>'; 
                                echo form_button(array('name'=>'valider','type'=>'submit','class'=>'btn', 'content'=>'<i class="fa fa-check-circle fa-lg text-success"></i>'));
                                echo '</form>';
                            }
                            
                            //Si la réservation est en attente ou modifiée on peut alors la validée
                            if($LesReservations['valide'] == "En attente de validation" || $LesReservations['valide'] == "Modifiée"){
                                echo form_open('GestionReservation');
                                echo '<input name="idReservationRefus" type="hidden" value="'.$LesReservations['id_reservation'].'"/>'; 
                                echo form_button(array('name'=>'refuser','type'=>'submit','class'=>'btn', 'content'=>'<i class="fa fa-times-circle fa-lg text-danger"></i>'));
                                echo '</form>';
                            }
                           
                            //Si la réservation est en attente ou modifiée on peut alors la modifiée
                            if($LesReservations['valide'] == "En attente de validation" || $LesReservations['valide'] == "Modifiée"){
                                echo form_open('GestionReservation');
                                echo '<input name="idReservation" type="hidden" value="'.$LesReservations['id_reservation'].'"/>';
                                echo form_button(array('name'=>'modifier','type'=>'submit','class'=>'btn', 'content'=>'<i class="fa fa-pencil-square-o fa-lg text-warning"></i>'));
                                echo '</form>';
                            }
                            
                            //Si la réservation n'est pas valide alors on peut la supprimée
                            if($LesReservations['valide'] != "Validée"){
                                echo form_open('GestionReservation');
                                echo '<input name="idReservationSuppr" type="hidden" value="'.$LesReservations['id_reservation'].'"/>';
                                echo form_button(array('nom'=>'supprimer','type'=>'submit','class'=>'btn', 'content'=>'<i class="fa fa-trash fa-lg text-danger"></i>'));
                                echo '</form>';
                                
                            }
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
