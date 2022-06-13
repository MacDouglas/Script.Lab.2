<?php

$pattern = "/\"\w{3,4}\s.*[A-Z]{4}\/\d\.\d\"\s[4-5]{1}\d{2}\s\d\s?\"\W\"/";

$arr = array();

$handle = fopen("access.log", "r") or die($php_errormsg);
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if(preg_match($pattern,$line))
        {
            $keywords = preg_split("/\s\-\s\-\s/", $line);
            array_push($arr, $keywords[0]);
        }
    }
    fclose($handle);
}
echo nl2br("Подозрительные ip адресса:\n");

$unique =  array_unique($arr, SORT_STRING);
$dublicates = array_count_values($arr);
$adresses = array();

foreach ($unique as $value) {
    if($dublicates[$value] > 2){
        array_push($adresses, $value);
        echo nl2br("$value - $dublicates[$value]\n");
    }
}

//var_dump($adresses);


?>
