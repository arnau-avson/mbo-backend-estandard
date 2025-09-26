# Asegurar carpeta de salida
$outDir = "tests\xml_almacenados"
if (-not (Test-Path -Path $outDir)) {
    New-Item -ItemType Directory -Path $outDir | Out-Null
}

# Rutas absolutas
$txtPath  = (Resolve-Path "$outDir\test-results.txt").Path  2>$null
if (-not $txtPath) { $txtPath = Join-Path $outDir "test-results.txt" }
$htmlPath = Join-Path $outDir "test-results.html"
$pdfPath  = Join-Path $outDir "test-results.pdf"

# 1) Ejecutar tests y volcar a TXT (UTF-8)
php artisan test | Tee-Object -FilePath $txtPath | Out-Null

# 2) Generar HTML simple (UTF-8, con estilo básico)
$content = Get-Content $txtPath -Raw
$style = @"
<style>
  body { font-family: Arial, Helvetica, sans-serif; margin: 24px; }
  pre  { white-space: pre-wrap; word-wrap: break-word; }
  h1   { margin-top: 0; }
</style>
"@
$html = @"
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de Tests</title>
  $style
</head>
<body>
  <h1>Resultados de Tests</h1>
  <pre>$content</pre>
</body>
</html>
"@
# Forzar UTF-8 sin BOM
[System.IO.File]::WriteAllText($htmlPath, $html, New-Object System.Text.UTF8Encoding($false))

# 3) Convertir HTML -> PDF
function Convert-WithWkhtml {
    param($htmlPath, $pdfPath)
    $wk = Get-Command wkhtmltopdf.exe -ErrorAction SilentlyContinue
    if ($wk) {
        & $wk.Source --encoding utf-8 --print-media-type --enable-local-file-access `
            --margin-top 12mm --margin-right 12mm --margin-bottom 12mm --margin-left 12mm `
            "`"$htmlPath`"" "`"$pdfPath`""
        return $LASTEXITCODE
    }
    return $null
}

function Convert-WithChromium {
    param($htmlPath, $pdfPath)
    # Prueba con Chrome, Edge o Chromium
    $candidates = @(
        "$env:ProgramFiles\Google\Chrome\Application\chrome.exe",
        "$env:ProgramFiles(x86)\Google\Chrome\Application\chrome.exe",
        "$env:ProgramFiles\Microsoft\Edge\Application\msedge.exe",
        "$env:ProgramFiles(x86)\Microsoft\Edge\Application\msedge.exe",
        "chrome.exe", "msedge.exe", "chromium.exe"
    )
    foreach ($bin in $candidates) {
        $cmd = Get-Command $bin -ErrorAction SilentlyContinue
        if ($cmd) {
            & $cmd.Source --headless=new --disable-gpu --no-sandbox `
                --print-to-pdf="`"$pdfPath`"" "file:///$((Resolve-Path $htmlPath).Path.Replace('\','/'))"
            return $LASTEXITCODE
        }
    }
    return $null
}

$code = Convert-WithWkhtml -htmlPath $htmlPath -pdfPath $pdfPath
if ($code -eq 0) {
    Write-Host "PDF generado con wkhtmltopdf en $pdfPath."
} else {
    $code2 = Convert-WithChromium -htmlPath $htmlPath -pdfPath $pdfPath
    if ($code2 -eq 0) {
        Write-Host "PDF generado con Chrome/Edge headless en $pdfPath."
    } else {
        Write-Warning "No se pudo generar el PDF automáticamente."
        Write-Host "Soluciones:"
        Write-Host "  1) Instalar wkhtmltopdf y añadirlo al PATH (recomendado)."
        Write-Host "     - Windows (chocolatey):  choco install wkhtmltopdf"
        Write-Host "  2) O usa Chrome/Edge instalados (el script ya lo intenta)."
        Write-Host "  3) Verifica que el ejecutable sea accesible desde esta sesión (PATH)."
    }
}
