<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>INSCRIPTION CVVEN</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url('css/form.css'); ?>"> 

</head>
<body>
<div class="register-form">
    <?= form_open('CreateUser'); ?>
        <h2 class="text-center">Modification administrateur</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nom" id="nom" name="nom" value="<?php $infoUtilisateur['nom']?>" required="required">
        </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Prenom" id="prenom" name="prenom" value="<?php $infoUtilisateur['prenom']?>" required="required">
        </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Pseudo" id="user" name="user" value="<?php $infoUtilisateur['login']?>" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Mot de passe" id="password" name="password">
            <input type="hidden" name="password2" value="<?php $infoUtilisateur['mdp']?>" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="Envoyer" >Modifier</button>
            <br>
            <?php echo anchor('Connexion', '<input class="btn btn-danger btn-block" value="Annuler" />'); ?>
        </div>
        <div class="clearfix">
        </div>
    </form>
</div>
</body>
</html>
