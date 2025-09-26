<?php
    namespace App\Console\Commands;
    use Illuminate\Console\Command;
    use Barryvdh\DomPDF\Facade\Pdf;
    use Symfony\Component\Process\Process;

    class RunTestsToPdf extends Command {
        protected $signature = 'tests:pdf';
        protected $description = 'Ejecuta los tests y genera un PDF con los resultados';

        public function handle(): int {
            $outputDir = base_path('tests/xml_almacenados');
            if (!is_dir($outputDir)) {
                mkdir($outputDir, 0777, true);
            }

            $junit = $outputDir . '/junit.xml';
            $pdf = $outputDir . '/test-results.pdf';


            $env = array_merge($_ENV, $_SERVER, [
                'APP_ENV' => 'testing',
                'APP_DEBUG' => 'true',
                'DB_CONNECTION' => 'sqlite',
                'DB_DATABASE' => ':memory:',
                'CACHE_DRIVER' => 'array',
                'SESSION_DRIVER' => 'array',
                'QUEUE_CONNECTION' => 'sync',
                'MAIL_MAILER' => 'log',
                'MAIL_FROM_ADDRESS' => 'no-reply@example.com',
                'MAIL_FROM_NAME' => config('app.name', 'MBO'),
            ]);


            $process = new Process(['php', 'artisan', 'test', '--colors=never', '--log-junit', $junit]);
            $process->setEnv($env);
            $process->setTimeout(null);
            $output = '';
            $process->run(function ($type, $buffer) use (&$output) {
                $output .= $buffer;
                echo $buffer;
            });

            $exitCode = $process->getExitCode();

            if (!file_exists($junit)) {
                $this->error("No se generó junit.xml");
                return 1;
            }


            // Extraer totales de la salida textual
            $summary = [
                'tests' => 0,
                'failures' => 0,
                'errors' => 0,
                'skipped' => 0,
                'time' => '',
            ];
            if (preg_match('/Tests:\s+(\d+)/', $output, $m)) {
                $summary['tests'] = (int)$m[1];
            }
            if (preg_match('/(failures|failed):\s*(\d+)/i', $output, $m)) {
                $summary['failures'] = (int)$m[2];
            }
            if (preg_match('/errors?:\s*(\d+)/i', $output, $m)) {
                $summary['errors'] = (int)$m[1];
            }
            if (preg_match('/omitted|skipped:\s*(\d+)/i', $output, $m)) {
                $summary['skipped'] = (int)$m[1];
            }
            if (preg_match('/Duration:\s*([\d\.]+)s/', $output, $m)) {
                $summary['time'] = $m[1];
            }


            $checkCount = preg_match_all('/^\s*[✓]/mu', $output);
            $failCount = preg_match_all('/^\s*[✗]/mu', $output);
            $now = now();
            $datetimeStr = $now->format('Y-m-d_H-i-s');
            $pdf = $outputDir . "/test-results-{$datetimeStr}.pdf";
            $html = view('tests.report', [
                'summary' => $summary,
                'output' => $output,
                'datetime' => $now->format('Y-m-d H:i:s'),
                'checkCount' => $checkCount,
                'failCount' => $failCount,
            ])->render();
            Pdf::loadHTML($html)->save($pdf);

            $this->info("✅ PDF generado en {$pdf}");

            return $exitCode;
        }
    }
