<?php
$string="";
if(isset($_POST['test'])){
    $numbers=$_POST['test'];
    
    foreach($numbers as $number){
        $string.=$number.",";
    }
}
var_dump($string);


?>