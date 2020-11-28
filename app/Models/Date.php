<?php 

class Date {

    private $date;
    private $formatDate;
    public function __construct($date){
        $this->date = $date;
        $this->formatDate = "YYYY-MM-DD";
        $this->changeDateFormat(); 
    }

    public function getDate(){
        return $this->date;
    }

    public function getFormatDate(){
        return $this->formatDate;
    }

    //Retourne l'année
    public function getYear(){
        return $this->cutDate("YYYY");
    }
    
    //Retourne le Jour
    public function getDay(){
        return $this->cutDate("DD");
    }

    //Retourne le mois
    public function getMonth(){
        return $this->cutDate("MM");
    }

    //Retourne la date sous forme de tableau
    public function getTabDate(){
        return Date::explodeValue($this->getDate());
    }

    //Retourne le format sous forme de tableau
    public function getTabFormatDate(){
        return Date::explodeValue($this->getFormatDate());
    }

    /*
    -fonction : Modifie la date
    -parametre : date => String
    -retour : void     */
    public function setDate($date){
        $this->date = $date;
    }

    /*
    -fonction : Modifie le format de la date
    -parametre : $formatDate => String
    -retour : void     */
    public function setFormatDate($formatDate){
        $this->formatDate = $formatDate;
    }

    /*
    -fonction : Change le format de la date
    -parametre : $formatDate => String => setByDefault('YYYY-MM-DD') => Correspond au format souhaité
    -retour : void     */
    public function changeDateFormat($formatDate = "YYYY-MM-DD"){
        $formatDate = strtoupper($formatDate);
        $tabFormatDateTemp = Date::explodeValue($formatDate);

        $tabDate = $this->getTabDate();
        $tabFormatDate = $this->getTabFormatDate();

        $newDate = [];

        for($j = 0; $j < count($tabFormatDateTemp); $j++){
            if($tabFormatDateTemp[$j] == $tabFormatDate[$j]){
                $newDate[] = $tabDate[$j];
            }
        }

        $this->setFormatDate($formatDate);
        $this->setDate($newDate[0]."-".$newDate[1]."-".$newDate[2]);
    }
    
    /*
    -fonction : Permet de séparer la partie de la date que l'on souhaite(Jour,Mois ou Année)     
    -parametre : -cutformatdate => string contenant la partie de la date qu'on veut soit "DD" soit "MM" soit "YYYY"     
    -retour : string || bool => correspond au champs date sélectionné ou renvoie false s'il ne trouve pas     */
    private function cutDate($cutFormatDate){
        for ($i=0; $i < count($this->getTabDate()); $i++) { 
            for($j = 0; $j < count($this->getTabFormatDate()); $j++){
                if($this->getTabFormatDate()[$j] == $cutFormatDate){
                    return $this->getTabDate()[$j];
                }
            }
        }
        return false;
    }
    
    /*
    -fonction : Permet de séparer une chaine de caractère séparé par un séparateur    
    -parametre :   -value => string(avec des séparateur)
                   -separateur => char ou string => setByDefault(null)     
    -retour : Retourne un tableau ou false si le separateur n'as pas été trouvée     */
    public static function explodeValue($value,$separateur = ""){
        if(!empty($separateur)){
            if(strpos($value, $separateur)){
                return explode($separateur, $value);
            }
            else{
                return false;
            }
        }
        else{
            if(strpos($value, "-")){
                return explode("-", $value);
            }
            elseif(strpos($value, "/")){
                return explode("/", $value);
            }
            else{
                return false;
            }
        } 
        
    }
}

?>