@echo off
setlocal ENABLEDELAYEDEXPANSION

:: Config
set "DB_USER=root"
set "DB_PASSWORD="
set "BACKUP_ROOT=C:\xampp\mysql\backups"
set "MYSQLDUMP=C:\xampp\mysql\bin\mysqldump.exe"
set "MYSQL=C:\xampp\mysql\bin\mysql.exe"

set "SYS_AMS_DB=ams"
set "SYS_CAPP_DB=capp"
set "SYS_MOODLE_DB=moodle"

:: ensure mysqldump exists
if not exist "%MYSQLDUMP%" (
  echo [FATAL] mysqldump not found at "%MYSQLDUMP%". Check path.
  exit /b 2
)

if not exist "%BACKUP_ROOT%" mkdir "%BACKUP_ROOT%"

for /f "usebackq delims=" %%I in (`powershell -NoProfile -Command "(Get-Date).ToString('yyyy-MM-dd_HH-mm-ss')"`) do set "STAMP=%%I"

:: Auth flags
set "AUTH=-u %DB_USER%"
if defined DB_PASSWORD set "AUTH=-u %DB_USER% -p%DB_PASSWORD%"

:: Backups
call :backup_one "ams"    "%SYS_AMS_DB%"
call :backup_one "capp"    "%SYS_CAP_DB%"
call :backup_one "moodle" "%SYS_MOODLE_DB%"

echo All done. Backups are under %BACKUP_ROOT%\^<system^>\
exit /b 0

:backup_one
REM %1 = system folder name
REM %2 = database name
set "_SYS=%~1"
set "_DB=%~2"

:: fallback if DB name empty
if "%_DB%"=="" (
  echo [WARN] No DB mapping for system "%_SYS%". Falling back to system name as DB: "%_SYS%"
  set "_DB=%_SYS%"
)

set "_DIR=%BACKUP_ROOT%\%_SYS%"
if not exist "%_DIR%" mkdir "%_DIR%"
if errorlevel 1 (
  echo [ERROR] Cannot create/access "%_DIR%" & exit /b 1
)

set "_OUT=%_DIR%\%_DB%_%STAMP%.sql"
set "_LOG=%_OUT%.log"

echo [INFO] Dumping DB "%_DB%" -> "%_OUT%" ...
"%MYSQLDUMP%" %AUTH% "%_DB%" > "%_OUT%" 2> "%_LOG%"

if errorlevel 1 (
  echo [ERROR] Dump failed for DB "%_DB%". See "%_LOG%" for details.
  echo ----- LOG START ----- 
  type "%_LOG%"
  echo ----- LOG END -----
) else (
  echo [OK] "%_DB%" -> "%_OUT%"
  del /q "%_LOG%" >nul 2>&1
)
exit /b 0