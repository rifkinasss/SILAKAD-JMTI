<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDataTugasAkhir extends Mailable
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
            ->view('emails.confirm_demand.data_tugas_akhir')
            ->with([
                'dataTugasAkhir' => $this->dataTugasAkhir,
                'user' => $this->dataTugasAkhir->user,
            ]);
    }
}
