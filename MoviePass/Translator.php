<?php 

class Translator{

    public static function Translate($day){
        if($day->format('l')=='Wednesday'){
          $day="Miercoles";
        }elseif($day->format('l')=='Thursday'){
          $day="Jueves";
        }elseif($day->format('l')=='Friday'){
          $day="Viernes";
        }elseif($day->format('l')=='Saturday'){
          $day="Sabado";
        }elseif($day->format('l')=='Sunday'){
          $day="Domingo";
        }elseif($day->format('l')=='Monday'){
          $day="Lunes";
        }elseif($day->format('l')=='Tuesday'){
          $day="Martes";
        }
        return $day;
    }
}

?>