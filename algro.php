<?php 
include ('class_lib.php');
include('dbfuncs.class.php');

$db = new Database();
$db->connect();

function racediff(){
    $racers=array(retrieveRunnerData());
    $racerslength=count($racers);
    for($x=0;$x<$arrlength;$x++){
        $racer=$racers[$x];
        $racerid=$racer[0];
        $runnerdata=retrieveAllRunnerData($runnerid, $i, $j);
        $datalength=count($runnerdata);
        for($i=0;$i<$arrlength;$i++){
            $data=$runnerdata[$i];
            $pos=$data[0];
            if($pos<6){
                $per=$data[4];
                $datarace=$data[1];
                $races=array(retrieveRaceData($y,$z ));
                for($z=0;$z<$arrlength;$z++){
                    $race=$races[$z];
                    $racename=$race[1];
                    $dif=$race[11];
                    if($datarace==$racename){   
                        $dif=$dif+(100-($per-100));
                        insertRace($race,$dif);
                    }
                }
            }
        }
    }
}

function runnerdiff(){
    $racers=array(retrieveRunnerData());
    $racerslength=count($racers);
    for($x=0;$x<$arrlength;$x++){
        $racer=$racers[$x];
        $racerid=$racer[0];
        $runnerdata=retrieveAllRunnerData($runnerid, $i, $j);
        $datalength=count($runnerdata);
        for($i=0;$i<$arrlength;$i++){
            $data=$runnerdata[$i];
            $datarace=$data[1];
            $races=array(retrieveRaceData($y,$z ));
            for($z=0;$z<$arrlength;$z++){
                $race=$races[$z];
                $racename=$race[1];
                $dif=$race[11];
                if($datarace==$racename){
                    $runnerdif=$runnerdif+$dif;
                }
            }
        }
    }
}

function racerbands($array){
       $maxraces=maxNoRaces($array);
       $bandseperator=$maxraces/10;
       $racebands=array($bandseperator);
       $x=$bandseperator*2;
       $i=1;
       while($x<=$maxraces){
           array_push($racebands,$x);
           $x=$x+$bandseperator;
           }
       return $racebands;
}

  function maxNoRaces($array){
   $x=$array[0];
   $max=$x->getNoRaces();
   $arrlength=count($array);
   for($i=0;$i<$arrlength;$i++){
       $noraces=$array[$i]->getNoRaces();
       if($noraces>$max){
           $max=$noraces;
       }
   }
   return $max;
}
?> 
