@echo off
set db_user=root
set db_password=
set backup_path=C:\xampp\mysql\backups
set mysqldump_path=C:\xampp\mysql\bin\mysqldump.exe

REM Create backup directory if it doesn't exist
if not exist %backup_path% mkdir %backup_path%

REM Get current date and time
set datetime=%date:~-4%-%date:~4,2%-%date:~7,2%_%time:~0,2%-%time:~3,2%-%time:~6,2%
set datetime=%datetime: =0%

REM Backup each database
for %%f in (ams capp) do (
    %mysqldump_path% -u %db_user% -p%db_password% %%f > %backup_path%\%%f_%datetime%.sql
)