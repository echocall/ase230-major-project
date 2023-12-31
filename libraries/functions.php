<?php  
    // hold the functions for interacting with the data of groups/guilds.

// User Specific Functions
// Translates a users's message status from a number to a string.
function userMessageStatus($boolean){
    switch($boolean){
        case true:
            $statusAsText = 'Open';
            break;
        case false:
            $statusAsText = 'Closed';
            break;
    }

    return $statusAsText;
}
function guildJoinStatus($freeToJoin): string
{
    return $freeToJoin ? 'Yes' : 'No';
}
// Translates a users's message status from a number to a string.
function userInviteStatus($boolean){
    switch($boolean){
        case true:
            $statusAsText = 'Yes';
            break;
        case false:
            $statusAsText = 'No';
            break;
    }

    return $statusAsText;
}// assemble the form info into an array.
function newUserArrayBuilder($username,$password,$profilePicture,$games,$otherAccounts){

    $updatedTarget=array('username'=>$username,'name'=>$_POST['name'],'email'=>$_POST['email'],'timeZone'=>$_POST['timeZone'],'playTime'=>$_POST['playTime'],'games'=>$games,'otherAccounts'=>$otherAccounts,'openToInvite'=>$_POST['openToInvite'],'messagesOpen'=>$_POST['messagesOpen']);
   
    return $updatedTarget;
 }


// Group Specific FUnctions
// Translates a group's join status from a number to a string.
function groupJoinStatus($int){
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
        default:
            $statusAsText = 'Error';
            break;
    }

    return $statusAsText;
}
// assemble the form info into an array.
function newGroupArrayBuilder($games,$members){
   $webText="";
   $webLink="";
   // check values for website and webText
   if($_POST['website'] == ''){
       $webLink = '#';
   }
   else{
       $webLink = $_POST['website'];
   }
   if($_POST['webText']==''){
       $webText == 'None';
   }else{
       $webText == $_POST['webText'];
   }

   $updatedTarget=array('name'=>$_POST['groupName'],'id'=>$_POST['groupID'],'type'=>$_POST['type'],'games'=>$games,'website'=>$webLink,'webText'=>$webText,'bio'=>$_POST['bio'],'members'=>$members,'freeToJoin'=>$_POST['newMembers']);
  
   return $updatedTarget;
}
// Gets a specific Group's ranks from the CSV file ranks.csv
function getGroupRanks($array, $groupID){
   // get the ranks of a specific guild
   $groupRanks = array(); 
   $index = 0;
   
   // step through the array of all Guild Ranks
   foreach($array as $rankList)
   {
       // if guildID matches target guildID, write info off.
       if($rankList[$index] == $groupID){
           $groupRanks = $rankList;
           break;
       }else{
           continue;
       }
   }

   return $groupRanks;
}

// General Use Functions
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
// pulls data from a multiline CSV file.
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
// Reads a single-line csv file, like games.csv
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
// Creates a new group in the preexisting JSON file.
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
// Updates a preexisting group in groups.json
// TODO: update to use newGroupAsArray
function updateInJSON($file,$array,$index){
    // read file.
    $outerTargetArray=file_get_contents($file);
    // convert string into a PHP array
    $outerTargetArray=json_decode($outerTargetArray,true);

   // update the element
   $outerTargetArray[$index]=$array;

   // Encode the array into a JSON string
   $outerTargetArray=json_encode($outerTargetArray,JSON_PRETTY_PRINT);
   // Save the file
   file_put_contents($file,$outerTargetArray);

    return true;
}
// Removes a specific Group from the JSON file
function deleteFromJSON($file,$index){
    // read file.
    $originalFile=file_get_contents($file);
    // convert string into a PHP array
    $originalFile=json_decode($originalFile,true);

   // remove the element
   unset($originalFile[$index]);
   
   // restores array as index array.
   $updatedList=array_values($originalFile);

   // Encode the array into a JSON string
   $updatedList=json_encode($updatedList,JSON_PRETTY_PRINT);
   // Save the file
   file_put_contents($file,$updatedList);

    return true;
}
// returns a single Item's information from the larger array.
function getItem($array,$index){
    $item = $array[$index];

    return $item;
}