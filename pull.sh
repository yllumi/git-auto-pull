#!/bin/bash

source=/home/toharyan/Developments/autopull
repos="public/repos"

while IFS= read -r line
do
	echo $line | while read col
	do
		IFS=" "
	  	set - $col
  		REPONAME=$1
  		REPOFOLDER=$2
  		REPOBRANCH=$3

	  	if test -f "mark/$REPONAME"; then
		    rm mark/$REPONAME
	  		echo "Pulling $REPOFOLDER"
	  		cd $REPOFOLDER
		    git pull origin $REPOBRANCH
		    echo $(date -u) "- $REPONAME - Successfully pulled"  >> "$source/log.txt"
	    else
		    echo $(date -u) "- $REPONAME - No action"  >> "$source/log.txt"
	  	fi
	done
done < "$repos"