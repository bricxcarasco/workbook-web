#!/bin/bash 

git remote rm heroku

git remote add heroku https://git.heroku.com/workbook-web.git

git push heroku master