<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de création de compte</title>
    </head>
    <body>
    <?= $validation->listErrors(); ?>
    <?= form_open('CreateUser'); ?>
    <h3>Page de création de compte</h3>
    
    <h5>Nom</h5>
    <input type="text" name="nom" placeholder="Nom" size="50"/>

    <h5>Prénom</h5>
    <input type="text" name="prenom" placeholder="Prénom" size="50"/>
    
    <h5>Login</h5>
    <input type="texte" name="user" placeholder="username" size="50"/>
    
    <h5>Mot de Passe</h5>
    <input type="password" name="password" placeholder="password" size="50"/>

    <br/><br/><br/>
    <div><input type="submit" value="Envoyer" />
    <?php echo anchor('Connexion', '<input type="button" value="Annuler"/>'); ?> </div>
    </form>
    </body>
</html>
