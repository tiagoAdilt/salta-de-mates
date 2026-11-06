@echo off
chcp 65001 > nul
echo ========================================================
echo  Salta de Mates - Importador de Base de Datos MySQL
echo ========================================================
echo.
echo Asegurate de que el modulo MySQL este INICIADO en XAMPP.
echo Importando salta_de_mates.sql...
echo.

"C:\xampp\mysql\bin\mysql.exe" -u root < "%~dp0salta_de_mates.sql"

if %ERRORLEVEL% EQU 0 (
    echo ========================================================
    echo  [EXITO] Base de datos 'salta_de_mates' importada con exito.
    echo  Se crearon la tabla 'lugares' y los 10 registros iniciales.
    echo ========================================================
) else (
    echo ========================================================
    echo  [ERROR] No se pudo conectar a MySQL (Codigo: %ERRORLEVEL%).
    echo  Verifica que MySQL este en verde (Running) en el XAMPP Control Panel.
    echo ========================================================
)
echo.
pause
