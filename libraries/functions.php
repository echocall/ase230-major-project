<?php  
    // hold the functions for interacting with the data of groups/guilds.

// reads json file and turns it into an array.
function readJSONFile($file){
    
    // $file=fopen($fp,'r');
    // check if file exists and is readable. Stolen from bit of code Jacob shared
    if(!file_exists($file) || !is_readable($file)) return false;
    // get content from the file
    $content=file_get_contents($file);
    $content=json_decode($content,true);

    return $content;
    fclose($fp);
}

// returns a single guild's information from the larger array.
function getGuild($array,$index){
    $guild = $array[$index];

    return $guild;
}

function guildJoinStatus($int){
    switch($int){
        case 1:
            $statusAsText = 'Open';
            break;
        case 2:
            $statusAsText = 'Invite Only';
            break;
        case 3:
            $statusAsText = 'Closed';
            break;
    }

    return $statusAsText;
}

function readCSVFile($file){
    // pulls info from CSV file.
    // check if file exists and is readable. Stolen from bit of code Jacob shared
    if(!file_exists($file) || !is_readable($file)) return false;

    // Everything else below is modified from 09-csv-read.php
    // create array to return
    $outerArray=array();
    // open file with fOpen & get path
    $fp=fopen($file,'r');

    // writes the contents into an array.
    while(!feof($fp)){
   
        // trim white spaces at start of the line.
        $line=trim(fgets($fp));
        $line=preg_replace('/(^"|"$)/','',$line);
   
        // check the line has characters in it.
        if(strlen($line)>0){
            // turn line into an array.
            print_r($line);
            $content=explode(',',$line);
            array_push($outerArray,$content);
            }else{
                continue;
            }
    }
    return $outerArray;
    // close the file.
    fclose($fp);
}

function readCSVFileLine($file){
    // pulls info from CSV file.
    // check if file exists and is readable. Stolen from bit of code Jacob shared
    if(!file_exists($file) || !is_readable($file)) return false;

    // Everything else below is modified from 09-csv-read.php
    // create array to return
    $outerArray=array();
    // open file with fOpen & get path
    $fp=fopen($file,'r');

    // writes the contents into an array.
    while(!feof($fp)){
   
        // trim white spaces at start of the line.
        $line=trim(fgets($fp));
        $line=preg_replace('/(^"|"$)/','',$line);
   
        // check the line has characters in it.
        if(strlen($line)>0){
            // turn line into an array.
            $content=explode(',',$line);
            }else{
                continue;
            }
    }
    return $content;
    // close the file.
    fclose($fp);
}

function createInJSON($file,$newItem){
    // takes an array to add to JSON file.
    if(!file_exists($file) || !is_readable($file)) return false;

    // read file.
    $originalContent=file_get_contents($file);

    // convert string from file into a PHP array
    $content=json_decode($originalContent,true);
    // add the new item into the array
    array_push($content,$newItem);

    // Encode the array into a JSON string
    $content=json_encode($content,JSON_PRETTY_PRINT);
    // Save the file
   file_put_contents($file,$content);

    return true;
}

function newGroupAsArray(){
    // assemble the form info into an array.


    return $newgroup;
}

function getGroupRanks($array, $groupID){
    // get the ranks of a specific guild
    $guildRanks = array(); 
    $index = 0;

    // step through the array of all Guild Ranks
    for($index; i < count($array); $index++){
        // if guildID matches target guildID, write info off.
        if($array[0] == $groupID){
            $groupRanks = $array[index];
            break;
        }else{
            continue;
        }
        
    }

    return $guildRanks;
}