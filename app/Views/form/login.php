<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>CVVEN CONNEXION</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url('css/form.css'); ?>"> 
</head>
<body>
<div class="login-form">
    <?= form_open('Connexion'); ?>
        <h2 class="text-center">Connexion</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Identifiant" id="user" name="user" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Mot de passe" id="password" name="password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="Envoyer" >Connexion</button>
        </div>
        <div class="clearfix">
             <?php if(isset($validation)){
                echo $validation->listErrors();}?>
        </div>
    </form>
    <p class="text-center"><?php echo anchor('CreateUser', 'Créer un compte'); ?></p>
</div>
</body>
</html>

