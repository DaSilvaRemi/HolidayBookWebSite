<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de connection</title>
    </head>
    <body>
    <?= form_open('Connexion'); ?>
    <h3>Page de connection</h3>
    
    <?php if($validation->listErrors() != null){
        $validation->listErrors();
    }?>
    <?php if(isset($connexion)){
     echo $connexion;
    } ?>
    <h5>Utilisateur</h5>
    <input type="text" name="user" placeholder="utilisateur" size="50"/>

    <h5>Mot de passe</h5>
    <input type="password" name="password" placeholder="password" size="50"/>

    <br/><br/><br/>
    <div><input type="submit" value="Envoyer" />
        <input type="reset" value="Annuler" /></div>
    <br/><br/>
    <div><?php echo anchor('CreateUser', '<input type="button" value="Créer un compte" />'); ?> </div>

    </form>
    </body>
</html>
