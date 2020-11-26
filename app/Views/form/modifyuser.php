<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Page de connexion</title>
    </head>
    <body>
    <section class="formulaire">
    <?= form_open('Connexion'); ?>
      
    
    <?php if(isset($connexion)){
     echo $connexion;
    } ?>
        
    <h3>Page de connexion</h3>
    
    <label for="user">Utilisateur</label>
    <input type="text" name="user" placeholder="utilisateur" size="50"/>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" placeholder="password" size="50"/>

    <br/><br/><br/>
    <div><input type="submit" value="Envoyer" />
        <input type="reset" value="Annuler" /></div>
    <br/><br/>
    <div><?php echo anchor('CreateUser', '<input type="button" value="Créer un compte" />'); ?> 
    
    <?php if(isset($validation)){
        echo $validation->listErrors();
    }?>

    </form>
    </section>
    </body>
</html>
