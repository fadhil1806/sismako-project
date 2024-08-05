<?php
// app/Jobs/FileSetupJob.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class FileSetupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $nama;
    protected $prefix;
    protected $namaDir;
    protected $path;

    public function __construct(UploadedFile $file, $nama, $prefix, $namaDir, $path = '')
    {
        $this->file = $file;
        $this->nama = $nama;
        $this->prefix = $prefix;
        $this->namaDir = $namaDir;
        $this->path = $path;
    }

    public function handle()
    {
        $imageFileName = $this->prefix . str_replace(' ', '_', $this->nama) . '.' . $this->file->getClientOriginalExtension();
        $fullPath = public_path('img/tendik/' . $this->namaDir . $this->path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        $this->file->move($fullPath, $imageFileName);
    }
}

