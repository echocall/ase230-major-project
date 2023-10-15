<?php
// Set the Content-Type to application/json
header('Content-Type: application/json');

// Read and echo the content of the JSON file
echo file_get_contents('data/groups/groups.json');

