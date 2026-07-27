<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Throwable;

class DeployApplicationJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        try {

            if (PHP_OS_FAMILY === 'Windows') {
                Log::channel('deploy')->info('Deployment skipped on Windows.');
                return;
                }

            Log::channel('deploy')->info('========== DEPLOY START ==========');
            $result = Process::timeout(900)->run([
                'bash',
                base_path('deploy.sh'),
            ]);

            Log::channel('deploy')->info($result->output());

            if (! $result->successful()) {

                Log::channel('deploy')->error($result->errorOutput());

                throw new \Exception($result->errorOutput());
            }

            Log::channel('deploy')->info('========== DEPLOY SUCCESS ==========');

        } catch (Throwable $e) {

            Log::channel('deploy')->error($e->getMessage());

            Log::channel('deploy')->error($e->getTraceAsString());

            throw $e;
        }
    }
}