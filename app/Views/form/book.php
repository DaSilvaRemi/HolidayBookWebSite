<head>
    <title>Réservation de séjour</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>RESERVATIONS CVVEN</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url('css/form.css'); ?>"> 
</head>
</head>
<body>
<div class="Sejour-form">
    <?= form_open('BookForm'); ?>
        <h2 class="text-center">Effectuer réservation</h2>       
        <div class="form-group">
            <select name="typelogement" class="form-control">
        <option value="">-----Veuillez sélectionnez une option------</option>
        <?php 
        if(isset($data)){
           foreach ($data as $tabTypeLogement) {
                echo '<option value="'.$tabTypeLogement["typelogement"].'">'.$tabTypeLogement["typelogement"].'</option>';  
            }  
        }   ?>        
    </select>
        </div>  
          <div class="form-group">
            <input type="date" name="datedebut" min="2021-01-01" size="50" step="7" class="form-control"/>
        </div>
          <div class="form-group">
            <input type="date" name="datefin" min="2021-01-08" size="50" step="7" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="number" name="nbpersonne" min="1" max="4" value="1" size="50"  class="form-control"/>
        </div>
        <div class="form-group">
            <select name="pension" class="form-control">
                <option value="">-----Veuillez sélectionnez une pension-----</option>
                <option value="pensioncomplete">pension complète</option>
                <opion value="demipension">demi-pension</option>
            </select>
        </div>
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
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block" id="Envoyer" >Je réserve !</button>
        </div>
    </form>
</div>
</body>
</html>
