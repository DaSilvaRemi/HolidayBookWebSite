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
          <li class="nav-item active">
            <?php echo anchor('BookForm', 'Reservations','class="nav-link"'); ?>
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <?php echo anchor('PageUser', 'Mes reservations','class="nav-link"'); ?>
          </li>
          <li class="nav-item">
            <?php echo anchor('Connexion', 'Connexion','class="nav-link"'); ?>
          </li>
          <li class="nav-item">
            <?php echo anchor('Connexion/deconnexion', 'Deconnexion','class="nav-link"'); ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>