<head>
    <title>Réservation de séjour</title>
</head>
<body>
    <br/><br/><br/><br/>
    <div class="container">
    <?= form_open('BookForm'); ?>
    <h3>Réservation de séjour</h3>
    
    <div class="form-group">
    <label for="typelogement">Type de logement</label>
    <select name="typelogement" class="form-control">
        <option value="">-----Veuillez sélectionnez une option------</option>
        <?php 
        if(isset($data)){
           foreach ($data as $tabTypeLogement) {
                echo '<option value="'.$tabTypeLogement["typelogement"].'">'.$tabTypeLogement["typelogement"].'</option>';  
            }  
        }   
 ?>        
    </select>
    </div>
    
    <div class="form-group">
    <label for="datedebut">Date Début</label>
    <input type="date" name="datedebut" min="2020-11-07" size="50" step="7" class="form-control"/>
    </div>

    <div class="form-group">
    <label for="datefin">Date de Fin</label>
    <input type="date" name="datefin" min="2020-11-07" size="50" step="7" class="form-control"/>
    </div>

    <div class="form-group">
    <label for="nbpersonne">Nombre de personnes</label>
    <input type="number" name="nbpersonne" min="1" max="4" value="1" size="50"  class="form-control"/>
    </div>

    <div class="form-group">
    <label for="pension">Choix de la pension</label>
    <select name="pension" class="form-control">
        <option value="">-----Veuillez sélectionnez une pension-----</option>
        <option value="pensioncomplete">pension complète</option>
        <option value="demipension">demi-pension</option>
    </select>
    </div>
    
    <h5>Options :</h5>
    
    <div class="form-check">
    <label for="menage" class="form-check-label">
    <input type="checkbox" name="menage" value="menage" class="form-check-input">
    Ménage fin de séjour</label>
    </div>
    
    <div class="form-group">
    <?php if(isset($validation)){
        echo $validation->listErrors();
    }?>
    </div>

    <input type="submit" value="Envoyer" class="btn btn-success btn-block"/>
    </form>
    </div>
    <br/><br/>
</body>
</html>

