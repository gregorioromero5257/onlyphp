#!/bin/bash
#This is a comment

#defining a variable

# git fetch > jow.txt;
# git pull origin main
# https://github.com/gregorioromero5257/onlyphp.git --- Cambiar esto por el nombre de su repositorio
git fetch https://github.com/gregorioromero5257/onlyphp.git refs/heads/main:upstream/main;
git checkout upstream/main
git log --pretty=format:"%hws-%an-%ar-%s" > new.txt
git checkout main
