<?php
class Racer{

    var $name;
    var $average;
    var $noRaces;
    var $ranking;
    var $band;

    function __construct($n,$a,$nr){  
        $this->name=$n;  
        $this->average=$a; 
        $this->noRaces=$nr; 
        $this->ranking=$a*$nr;
        $this->band=0;
        }  

    function ranking($average,$noRaces){
        $this->ranking=$average*$noRaces;
        return $this->ranking;
    }

    function getName(){
        return $this->name;
    }

    function setName($n){
        return $this->name=$n;
    }

    function getAvarage(){
        return $this->average;
    }

    function setAverage($a){
        return $this->average=$a;
    }

      function getNoRaces(){
        return $this->noRaces;
    }

    function setNoRaces($nr){
        return $this->noRaces=$nr;
    }

    function getRanking(){
        return $this->ranking;
    }

    function setRanking($r){
        return $this->ranking=$r;
    }

    function getBand(){
        return $this->band;
    }

    function setBand($b){
        return $this->band=$b;
    }
}

class Race{

    var $name;
    var $average;
    var $racers;
    var $ranking;

    function __construct($n,$r){  
        $this->name=$n;   
        $this->racers=$r;
        $arrlength=count($this->racers);
        for($i=0;$i<$arrlength;$i++){
          $racerranking=$r[$i]->getRanking();
          $ranking=$ranking+$racerranking;
        }
        $this->ranking=$ranking;  
    }


    function getName(){
        return $this->name;
    }

    function setName($n){
        return $this->name=$n;
    }

    function getRacers(){
        return $this->racers;
    }

    function setRacers($r){
        return $this->racers=$r;
    }

    function getRanking(){
        return $this->ranking;
    }

    function setRanking($r){
        return $this->ranking=$r;
    }
}
?>

