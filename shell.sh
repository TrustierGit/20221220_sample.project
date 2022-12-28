#!/bin/bash


while read TOKEN
do

curl -H "Authorization: Bearer $TOKEN" http://127.0.0.1:8000/api/MakeFileAPI


done < 'C:\Users\USER\Desktop\out.txt'

