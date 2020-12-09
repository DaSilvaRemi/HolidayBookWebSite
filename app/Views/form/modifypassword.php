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
<title>CHANGE MDP CVVEN</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url('css/form.css'); ?>"> 
</head>
<body>
<div class="changeMDP-form">
    <?= form_open('ModifyPassword'); ?>
        <h2 class="text-center">Modifier mon code d'accès</h2>       
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Nouveau mot de passe" id="password" name="password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirmer mot de passe" id="confirmPassword" name="confirmPassword" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" id="Envoyer" >Modifier</button>
            <br>
            <?php echo anchor('Home', '<input class="btn btn-danger btn-block" value="Annuler" />'); ?>
        </div>
        <div class="clearfix">
             <?php if(isset($validation)){
                echo $validation->listErrors();}?>
        </div>
    </form>
</div>
</body>
</html>

