#!/bin/bash

CURRENT_DIR=$(cd $(dirname $0);pwd)
LOG_DIR=$CURRENT_DIR/log
mkdir -p $LOG_DIR
LOG_FILE=$LOG_DIR/$(date +"%Y%m%d").log
touch $LOG_FILE

# 翌日日付を取得　※１のパラメータ
DAY=$(date +"%Y-%m-%d" --date "1 days")

echo $(date +"%Y-%m-%d %H:%M:%S") "-- START --" >> $LOG_FILE
TOKEN=$(mysql --defaults-extra-file=$CURRENT_DIR/sql.conf -N  -e 'SELECT remember_token FROM reservation_db.users WHERE `id`=1 ;')

# １．常時予約職員の翌日自動登録　パラメータに日付[$DAY]を付与
curl -H "Authorization: Bearer $TOKEN"  http://127.0.0.1:80/api/AutoReservationAPI?days=$DAY >> $LOG_FILE
#curl -H "Authorization: Bearer $TOKEN" http://127.0.0.1:80/api/AutoReservationAPI >> $LOG_FILE

# ２．翌日分のcsvファイル作成＆FTP転送
curl -H "Authorization: Bearer $TOKEN" http://127.0.0.1:80/api/MakeFileAPI >> $LOG_FILE

echo $(date +"%Y-%m-%d %H:%M:%S") "-- END --" >>  $LOG_FILE
