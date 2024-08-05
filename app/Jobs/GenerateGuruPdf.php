<?php

namespace App\Jobs;

use App\Models\Guru;
use Dompdf\Dompdf;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;


class GenerateGuruPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guruId;
    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($guruId, $filePath)
    {
        $this->guruId = $guruId;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $guru = Guru::findOrFail($this->guruId);

        // Load HTML content
        $html = View::make('template.guru_cv', compact('guru'))->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (important step!)
        $dompdf->render();

        // Save the PDF to the specified file path
        file_put_contents($this->filePath, $dompdf->output());
    }
}
