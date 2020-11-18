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
        return $this->cutDate("YYYY");
    }
    
    public function getDay(){
        return $this->cutDate("DD");
    }

    public function getMonth(){
        return $this->cutDate("MM");
    }

    private function cutDate($cutFormatDate){
        for ($i=0; $i < count($this->getTabDate); $i++) { 
            for($j = 0; $j < count($this->getTabFormatDate()), $j++){
                if($this->getTabFormatDate() == $cutFormatDate){
                    return $date[$j]
                }
            }
        }
    }

    public function getTabDate(){
        if(strpos($this->getFormatDate(), "-")){
            $tabDate = explode("-", $this->getDate());
        }
        elseif($this->getFormatDate(), "/"){
            $tabDate = explode("/", $this->getDate());
        }
        return $tabDate;
    }

    public function getTabFormatDate(){
        if(strpos($this->getFormatDate(), "-")){
            $tabFormatDate = explode("-", $this->getFormatDate());
        }
        elseif($this->getFormatDate(), "/"){
            $tabFormatDate = explode("/", $this->getFormatDate());
        }
        return $tabFormatDate;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function setFormatDate($formatDate){
        $this->formatDate = $formatDate;
    }

    public function changeDateFormat($formatDate = "YYYY-MM-DD"){
        $formatDate = strtoupper($formatDate);
        if(strpos($formatDate, "-")){
            $tabFormatDateTemp = explode("-", $formatDate);
        }
        elseif($formatDate, "/"){
            $tabFormatDateTemp = explode("/", $formatDate);
        }

        $tabDate = $this->getTabDate();
        $tabFormatDate = $this->getTabFormatDate();

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