<?php

namespace App\Mail\Terima;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DataTATerima extends Mailable
{
    use Queueable, SerializesModels;

    public $dataTugasAkhir;

    public function __construct($dataTugasAkhir)
    {
        $this->dataTugasAkhir = $dataTugasAkhir;
    }

    public function build()
    {
        return $this->subject('Permohonan Data Tugas Akhir')
            ->view('emails.terima.data_tugas_akhir')
            ->with([
                'dataTugasAkhir' => $this->dataTugasAkhir,
                'user' => $this->dataTugasAkhir->user,
            ]);
    }
}
