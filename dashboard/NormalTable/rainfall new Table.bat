@echo off
set /p id="Enter Table Number and Press Enter: "

IF EXIST "C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"  (exit)

type C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable1.php >> C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php

@echo off 
    setlocal enableextensions disabledelayedexpansion

    set "search=tr1"
    set "replace=tr%id%"

    set "textFile=C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        >>"%textFile%" echo(!line:%search%=%replace%!
        endlocal
    )
@echo off 
    setlocal enableextensions disabledelayedexpansion

    set "search=td1"
    set "replace=td%id%"

    set "textFile=C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        >>"%textFile%" echo(!line:%search%=%replace%!
        endlocal
    )
@echo off 
    setlocal enableextensions disabledelayedexpansion

    set "search=th1"
    set "replace=th%id%"

    set "textFile=C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        >>"%textFile%" echo(!line:%search%=%replace%!
        endlocal
    )
@echo off 
    setlocal enableextensions disabledelayedexpansion

    set "search=myTable1"
    set "replace=myTable%id%"

    set "textFile=C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        >>"%textFile%" echo(!line:%search%=%replace%!
        endlocal
    )
@echo off 
    setlocal enableextensions disabledelayedexpansion

    set "search=Table 1"
    set "replace=Table %id%"

    set "textFile=C:\inetpub\wwwroot\HydrometV2\dashboard\ReservoirTable%id%.php"

    for /f "delims=" %%i in ('type "%textFile%" ^& break ^> "%textFile%" ') do (
        set "line=%%i"
        setlocal enabledelayedexpansion
        >>"%textFile%" echo(!line:%search%=%replace%!
        endlocal
    )