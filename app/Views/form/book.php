<head>
    <title>Réservation de séjour</title>
</head>
<body>
    <section id="formulaire">
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
    
    <label for="datedebut">Date Début</label>
    <input type="date" name="datedebut" min="2020-11-07" size="50" step="7"/>

    <label for="datefin">Date de Fin</label>
    <input type="date" name="datefin" min="2020-11-07" size="50" step="7"/>

    <label for="nbpersonne">Nombre de personnes</label>
    <input type="number" name="nbpersonne" min="1" max="4" value="1" size="50" />

    <label for="nbpersonne">Nombre de personnes</label>
    <select name="nbpersonne">
        <option value="">-----Veuillez sélectionnez une option-----</option>
        <option value="pensioncomplete">pension complète</option>
        <option value="demipension">demi-pension</option>
    </select>
    
    <h5>Options :</h5>
    
    <label for="menage">Ménage fin de séjour</label>
    <input type="checkbox" name="menage" value="menage">

    <div><input type="submit" value="Envoyer" /></div>

    </form>
    </section>
</body>
</html>

