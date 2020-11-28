<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Changement de mot de passe</title>
    </head>
    <body>
    <section class="formulaire">
    <?= form_open('ModifyPassword'); ?>
    <h3>Changement de mot de passe</h3>
    <p>Vous serez rediriger sur la page de connexion après la demande</p>
   
    <h5>Mot de passe</h5>
    <input type="password" name="password" placeholder="password" size="50"/>

    <h5>Confirmer le mot de passe</h5>
    <input type="password" name="confirmPassword" placeholder="Confirm password" size="50"/>

    <br/><br/><br/>
    <div><input type="submit" value="Changer le mot de passe" />
    <?php echo anchor('Annuler', '<input type="reset" value="Annuler"/>'); ?> </div>
    <br/><br/>
    <?php if(isset($validation)){
        echo $validation->listErrors();
    }?>

    </form>
    </section>
    </body>
</html>
