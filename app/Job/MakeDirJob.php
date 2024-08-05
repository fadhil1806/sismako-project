<?php
// app/Jobs/MakeDirJob.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeDirJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mainDir;
    protected $subDir;

    public function __construct($mainDir, $subDir)
    {
        $this->mainDir = $mainDir;
        $this->subDir = $subDir;
    }

    public function handle()
    {
        $fullPath = public_path('img/' . $this->mainDir . '/' . $this->subDir);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }
    }
}
