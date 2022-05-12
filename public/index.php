<?php

/**
 * Pull
 * 
 * Marking making file for pull instruction.
 */
$name = $_GET['name'] ?? 'default';


// Get repository list
$repos = explode("\n", file_get_contents('repos'));
$repoArray = [];
foreach ($repos as $repo) {
    $temp = explode(" ", $repo);
    $repoArray[$temp[0]] = $temp[2]; // name => branch
}

// Get github payload
$payload = file_get_contents('php://input');
$payloadArr = json_decode($payload, true);
$ref = explode('/', $payloadArr['ref']);
$branchPushed = $ref[2];

// Check requirement
if(file_exists('../secret')){
    $secret = file_get_contents('../secret');
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
    if(! hash_equals($hash, $_SERVER['HTTP_X_HUB_SIGNATURE_256'])) die("Signature didn't match.");
}

if(!isset($repoArray[$name])) die("Repo name not registered.");
if($repoArray[$name] != $branchPushed) die("Pushed branch is not the target for pulling.");

$markFile = fopen("../mark/".$name, "w") or die("Unable to open file.");
fwrite($markFile, $repos[$name]);
fclose($markFile);
echo "Done!";

exec('../pull.sh');