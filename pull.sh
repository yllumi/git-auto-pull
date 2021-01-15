#!/bin/bash

BASE_PATH="/Applications/XAMPP/xamppfiles/htdocs/workspaces/apps.codepolitan.com"
FILE=$BASE_PATH/public/puller/mark.txt

if test -f "$FILE"; then
    cd "${BASE_PATH}"
    git pull origin master
    echo $(date -u) "Successfully pulled"  >> "${BASE_PATH}/public/puller/log.txt"
    rm "${BASE_PATH}/public/puller/mark.txt"
else
    echo $(date -u) "No action"  >> "${BASE_PATH}/public/puller/log.txt"
fi