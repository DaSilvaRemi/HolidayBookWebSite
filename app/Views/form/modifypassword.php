<!DOCTYPE html>
   <html>
      <head>
         <title>Profile</title>
         <meta charset="utf-8">

      </head>
   <body>

<!--header-->
<!--header-->
<!--Formulaire-->
 <?= form_open('Profile'); ?>
<h1>Profile</h1>
 <?php if(isset($validation)){
        $validation->listErrors();
    }?>
    <?php if(isset($connexion)){
     echo $connexion;
    } ?>
<!--mail-->
<form method="post">
   <h3><label for="mail">Votre mail</label></h3>
   <label for="mail">Adresse e-mail actuelle</label>  
   <input type="email" name="mail" id="mail" placeholder="Ex: nomcompte@gmail.com" maxlenght= "20" size="30" />
 
   <br>

   <label for="newmail">Nouvel e-mail</label>
   <input type="email" name="mail" id="newmail"/>

   <br>
   <br>
   <input type="submit" value="Envoyer"/>
   
   <!--mail-->
   <!--langue-->
   <h3><label for="langue">Votre langue</label></h3>
   <select name="langue" id="langue">
      <option value="france">France</option>
      <option value="epsagne">Espagne</option>
      <option value="italie">Italie</option>
      <option value="royaume-uni">Royaume-uni</option>
      <option value="canada">Canada</option>
      <option value="etats-unis">Etats-unis</option>
      <option value="japon">Japon</option>
      <option value="chine">Chine</option>
      <option value="france">France</option>
       </select>
       <br>
       <br>
   <input type="submit" value="Envoyer"/>

   <!--langue-->

    





    <!--mail-->
    <!--mot de passe-->
   <h3><label for="pass">Changer votre mot de passe</label></h3>
   
   <label for="newpass">Nouveau mot de passe</label>
   <input type="password" name="pass" id="newpass"/>
   <br>
   <label for="newpass">Réécrire nouveau mot de passe</label>
   <input type="password" name="pass" id="tapenewpass"/>
    <br>
    <br>
   <input type="submit" value="Changer votre mot de passe"/>

   

   

    <!--mot de passe-->

<!--Formulaire-->
<!--footer-->
<!--footer-->
</form>
</body>
</html> 
