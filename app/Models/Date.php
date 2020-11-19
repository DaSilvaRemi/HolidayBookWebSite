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

    public function getYear(){
        return $this->cutDate("YYYY");
    }
    
    public function getDay(){
        return $this->cutDate("DD");
    }

    public function getMonth(){
        return $this->cutDate("MM");
    }

    public function getTabDate(){
        return Date::explodeDate($this->getDate());
    }

    public function getTabFormatDate(){
        return Date::explodeDate($this->getFormatDate());
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setFormatDate($formatDate){
        $this->formatDate = $formatDate;
    }

    public function changeDateFormat($formatDate = "YYYY-MM-DD"){
        $formatDate = strtoupper($formatDate);
        $tabFormatDateTemp = Date::explodeDate($formatDate);

        $tabDate = $this->getTabDate();
        $tabFormatDate = $this->getTabFormatDate();

        $newDate = "";
        for($i = 0; $i < count($tabDate); $i++){
            for($j = 0; $j < count($tabFormatDateTemp); $j++){
                foreach($tabFormatDate as $FormatDate){
                    if($FormatDate == $tabFormatDateTemp[$j]){
                        $newDate = $tabDate[$j];
                    }
                }
            }
        }
        $this->setFormatDate($formatDate);
        $this->date = $newDate; 
    }
    
    private function cutDate($cutFormatDate){
        for ($i=0; $i < count($this->getTabDate()); $i++) { 
            for($j = 0; $j < count($this->getTabFormatDate()); $j++){
                if($this->getTabFormatDate()[$j] == $cutFormatDate){
                    return $this->getTabDate()[$j];
                }
            }
        }
    }
    
    public static function explodeDate($date){
        if(strpos($date, "-") !== false){
            return explode("-", $formatDate);
        }
        elseif(strpos($date, "/") !== false){
            return explode("/", $formatDate);
        }
        else{
            return false;
        }
    }
}

?>