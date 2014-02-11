<?php include ('class_lib.php');
   
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
   
   function loopArray($array){
   $arrlength=count($array);

   for($x=0;$x<$arrlength;$x++){
       echo $array[$x]->getName();
       echo ",";
       echo $array[$x]->getBand();
       echo ",";
       echo $array[$x]->getRanking();
       echo "<br>";
       }
   }

   function looprace($array){
   $arrlength=count($array);

   for($x=0;$x<$arrlength;$x++){
       echo $array[$x]->getRanking();
       echo "<br>";
       }
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

   function reorder($array){
       $x=$array[0];
       $min=$x->getRanking();
       $arrlength=count($array);
       for($i=0;$i<$arrlength;$i++){
           $ranking=$array[$i]->getRanking();
           if($ranking<$min){
               $temp=$array[0];
               $array[0]=$array[$i];
               $array[$i]=$temp;
               $min=$array[$i];
               }    
       }
       return $array;
   }

   function setBands($array){
       $bands=racerbands($array);
       $arrlength=count($array);
       $bandlength=count($bands);
       for($i=0;$i<$arrlength;$i++){
           for($x=0;$x<$bandlength;$x++){
               if($array[$i]->getNoRaces()<=$bands[$x]){
                   $array[$i]->setBand($x);
                   break;
               }
                   
           }
       }
   }
      
   $racer1=new Racer("Mark",100,10);  
   $racer2=new Racer("ASDN",95,1); 
   $racer3=new Racer("NMa",50,40); 
   $racers=array($racer1,$racer2,$racer3);
   loopArray($racers);
   setBands($racers);
   $racers=reorder($racers);
   loopArray($racers);
   $race=new Race("a",$racers);
   echo $race->getRanking();

?> 
