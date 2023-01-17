#!/bin/bash

CURRENT_DIR=$(cd $(dirname $0);pwd)
LOG_DIR=$CURRENT_DIR/log
mkdir -p $LOG_DIR
LOG_FILE=$LOG_DIR/$(date +"%Y%m%d").log
touch $LOG_FILE
echo $(date +"%Y-%m-%d %H:%M:%S") "-- START --" >> $LOG_FILE
TOKEN=$(mysql --defaults-extra-file=sql.conf -N  -e 'SELECT remember_token FROM reservation_db.users WHERE `id`=1 ;')
curl -H "Authorization: Bearer $TOKEN" http://127.0.0.1:80/api/MakeFileAPI >> $LOG_FILE
echo $(date +"%Y-%m-%d %H:%M:%S") "-- END --" >>  $LOG_FILE