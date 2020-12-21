<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Réservation de séjour</title>
<link rel="stylesheet" href="<?= base_url('css/form.css'); ?>"> 
</head>

<body>
<div class="Sejour-form">
    <?= form_open('ModifyReservation'); ?>
        <h2 class="text-center">Effectuer réservation</h2>       
        <div class="form-group">
            <select name="typelogement" class="form-control">
                <option value="">-----Veuillez sélectionnez une option------</option>
                    <?php 
                        if(isset($tabTypeLogement)){
                            echo '<option value="'.$tabTypeLogement["typelogement"].'">'.$tabTypeLogement["typelogement"].'</option>';  
                        }   ?>        
            </select>
        </div>  
        <div class="form-group">
            <input type="date" name="datedebut" min="2021-01-02" size="50" step="7" value="<?php $tabInfoReservation['datedebut']; ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="date" name="datefin" min="2021-01-09" size="50" step="7" value="<?php $tabInfoReservation['datefin']; ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="number" name="nbpersonne" min="1" max="4" size="50"  value="<?php $tabInfoReservation['nbpersonne']; ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <select name="pension" class="form-control">
                <option value="">-----Veuillez sélectionnez une pension-----</option>
                <option value="pensioncomplete">pension complète</option>
                <option value="demipension">demi-pension</option>
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
            <input type="hidden" name="idUpdateReservation" value="<?php $tabInfoReservation['id_reservation'];?>" class="form-check-input">
            <button type="submit" class="btn btn-success btn-block" id="Envoyer" >Modifier la réservation</button>
        </div>
    </form>
</div>
</body>
</html>
