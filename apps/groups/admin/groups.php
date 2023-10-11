<?php  
    // hold the functions for interacting with the data of groups/guilds.

// reads json file and turns it into an array.
function readJSONFile($fp){
    
    $file=fopen($fp,'r');
    // check if file exists and is readable. Stolen from bit of code Jacob shared
    if(!file_exists($file) || !is_readable($file)) return false;
    // get content from the file
    $content=file_get_contents($file);
    $content=json_decode($content,true);

    fclose($fp);
    return $content;
}

// returns a single product's information from the larger array.
function getProduct($array,$index){
    $product = $array[$index];

    return $product;
}