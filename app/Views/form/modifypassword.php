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
    <section class="formulaire">
    <?= form_open('Connexion'); ?>
    <h3>Page de connection</h3>
    
    <?php if(isset($validation)){
        $validation->listErrors();
    }?>
    <?php if(isset($connexion)){
     echo $connexion;
    } ?>
    <h5>Mot de passe</h5>
    <input type="password" name="password" placeholder="utilisateur" size="50"/>

    <h5>Confirmer le mot de passe</h5>
    <input type="password" name="confirmPassword" placeholder="password" size="50"/>

    <br/><br/><br/>
    <div><input type="submit" value="Changer le mot de passe" />
    <?php echo anchor('Annuler', '<input type="reset" value="Annuler"/>'); ?> </div>
    <br/><br/>

    </form>
    </section>
    </body>
</html>
