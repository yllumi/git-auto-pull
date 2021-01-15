<?php

/**
 * Pull
 * 
 * Marking making file for pull instruction.
 */
$name = $_GET['name'] ?? 'default';

$repos = explode("\n", file_get_contents('repos'));
$repoArray = [];
foreach ($repos as &$repo) {
 	$repo = substr($repo, 0, strpos($repo, " "));
} 
if(!in_array($name, $repos)) die("Repo name not registered.");

$markFile = fopen("../mark/".$name, "w") or die("Unable to open file.");
fwrite($markFile, $repos[$name]);
fclose($markFile);
echo "Done!";