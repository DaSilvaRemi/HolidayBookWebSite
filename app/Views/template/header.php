    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <?php echo anchor('Home', 'CVVEN','class="navbar-brand"'); ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php if(isset($iduser)){ 
            echo '<li class="nav-item active">';
            echo anchor('BookForm', 'Reservations','class="nav-link"'); 
            echo '<span class="sr-only">(current)</span>';
          echo '</li>'; }?>
          <li class="nav-item">
            <?php if(isset($iduser)){
                echo anchor('PageUser', 'Mes reservations','class="nav-link"'); 
            } 
            ?>
          </li>
          <li class="nav-item"> 
            <?php
            if(!isset($iduser)){
                echo anchor('Connexion', 'Connexion','class="nav-link"'); 
            }?>
          </li>
          <li class="nav-item"> 
            <?php
            if(isset($iduser)){
                echo anchor('ModifyPassword', 'Changer mot de passe','class="nav-link"'); 
            }?>
          </li>
          <li class="nav-item">
            <?php if(isset($iduser)){
            echo anchor('Connexion/deconnexion', 'Deconnexion','class="nav-link"'); 
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>