<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Resultados de Tests</title>
        <style>
            body {
                margin: 24px;
                font-family: DejaVu Sans, Arial, sans-serif;
            }

            ul {
                line-height: 1.6
            }
        </style>
    </head>

    <body>
        <div style="font-size:18px; margin-bottom:8px;">
            @if(strpos($output, 'FAIL') !== false)
                <span style="color:#c00;font-size:22px;">&#10060;</span>
            @else
                <span style="color:#090;font-size:22px;">&#9989;</span>
            @endif
            <strong>tests:pdf</strong>
            <span style="margin-left:24px; font-size:15px;">
                <span style="color:#090;">&#9989; {{ $checkCount ?? 0 }}</span>
                <span style="margin-left:12px; color:#c00;">&#10060; {{ $failCount ?? 0 }}</span>
            </span>
        </div>
        <div style="font-size:14px; margin-bottom:16px;"><strong>Fecha y hora:</strong> {{ $datetime }}</div>
        <pre style="font-size:13px; background:#f8f8f8; padding:16px; border-radius:6px; white-space:pre-wrap; font-family: 'DejaVu Sans Mono', 'Consolas', monospace;">PS C:\Users\ArnauBarrero\Desktop\mbo_standard_laravel\laravel&gt; php artisan tests:pdf

{{ rtrim($output) }}
</pre>
    </body>
</html>