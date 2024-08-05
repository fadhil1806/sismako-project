<?php
namespace App\Jobs;

use App\Models\Tendik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTendikPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tendik;
    protected $namaDir;
    protected $imageNamaFoto;

    public function __construct(Tendik $tendik, $namaDir, $imageNamaFoto)
    {
        $this->tendik = $tendik;
        $this->namaDir = $namaDir;
        $this->imageNamaFoto = $imageNamaFoto;
    }

    public function handle()
    {
        try {
            $filePath = public_path('files/tendik/' . $this->namaDir . '.pdf');

            if (!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0755, true);
            }

            $pdf = Pdf::loadView('template.tendik_cv', [
                'tendik' => $this->tendik,
                'namaDir' => $this->namaDir,
                'imageNamaFoto' => $this->imageNamaFoto
            ]);

            $pdf->save($filePath);
        } catch (\Exception $e) {
            // Handle the exception or log it
        }
    }
}

