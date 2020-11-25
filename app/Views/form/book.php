<html>
<head>
    <title>Réservation de séjour</title>
</head>
<body>

    <?= $validation->listErrors(); ?>
    <?= form_open('BookForm'); ?>

    <h5>Type Logement</h5>
    <select name="typelogement">
        <option value="">-----Veuillez sélectionnez une option------</option>
        <?php 
        if(isset($data)){
           foreach ($data as $tabTypeLogement) {
                echo '<option value="'.$tabTypeLogement["typelogement"].'">'.$tabTypeLogement["typelogement"].'</option>';  
            }  
        }   
 ?> 
           
    </select>
    
    <h5>Date debut</h5>
    <input type="date" name="datedebut" min="2020-11-07" size="50" step="7"/>

    <h5>Date de Fin</h5>
    <input type="date" name="datefin" min="2020-11-07" size="50" step="7"/>

    <h5>Nombre de personne</h5>
    <input type="number" name="nbpersonne" min="1" max="4" value="1" size="50" />

    <h5>Choix de la pension</h5>
    <select name="pension">
        <option value="">-----Veuillez sélectionnez une option-----</option>
        <option value="pensioncomplete">pension complète</option>
        <option value="demipension">demi-pension</option>
    </select>
    
    <h5>Options :</h5>
    
    <input type="checkbox" name="menage" value="menage">
    <label for="menage">Ménage fin de séjour</label>

    <div><input type="submit" value="Envoyer" /></div>

    </form>
</body>
</html>

