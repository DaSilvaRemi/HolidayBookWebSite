<? 

class Date {

    private $date;
    private $formatDate;
    public function __construct($date){
        $this->date = $date; 
        $this->formatDate = "YYYY-MM-DD";
    }

    public function getDate(){
        return $this->date;
    }

    public function getFormatDate(){
        return $this->formatDate;
    }

    public function getYear(){

    }
    
    public function getDay(){

    }

    public function getMonth(){

    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setFormatDate($formatDate){
        $this->formatDate = $formatDate;
    }

    public function changeDateFormat($formatDate = "YYYY-MM-DD"){
        if(strpos($formatDate, "-")){
            $tabFormatDateTemp = explode("-", $formatDate);
        }
        elseif($formatDate, "/"){
            $tabFormatDateTemp = explode("/", $formatDate);
        }

        if(strpos($this->getFormatDate(), "-")){
            $tabDate = explode("-", $this->getDate());
            $tabFormatDate = explode("-", $this->getFormatDate());
        }
        elseif($this->getFormatDate(), "/"){
            $tabDate = explode("/", $this->getDate());
            $tabFormatDate = explode("/", $this->getFormatDate());
        }

        $newDate = "";
        for($i = 0; $i < count($tabDate), $i++){
            for($j = 0; $j < count($tabFormatDateTemp), $j++){
                foreach($tabFormatDate as $FormatDate){
                    if($FormatDate == $tabFormatDateTemp[$j]){
                        $newDate = $date[$j];
                    }
                }
            }
        }
        $this->setFormatDate($formatDate);
        $this->date = $newDate; 
    }
}