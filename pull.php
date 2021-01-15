<?php

/**
 * Pull
 * 
 * Marking making file for pull instruction.
 */

$myfile = fopen("mark.txt", "w") or die("Unable to open file!");
$txt = "Marking for pull\n";
fwrite($myfile, $txt);
echo "Done!";
fclose($myfile);