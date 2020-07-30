#!/usr/bin/env bash

cd $ROOT && eval $(sed 's/^\"\(.*\)\"$/\1/g' <<< $NPM_COMMAND)