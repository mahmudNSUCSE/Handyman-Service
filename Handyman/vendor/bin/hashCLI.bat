@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../cr/hashcli/src/hashCLI
php "%BIN_TARGET%" %*
