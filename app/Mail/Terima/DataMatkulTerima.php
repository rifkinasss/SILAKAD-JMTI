<?php

namespace App\Mail\Terima;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DataMatkulTerima extends Mailable
{
    use Queueable, SerializesModels;

    public $dataMataKuliah;

    public function __construct($dataMataKuliah)
    {
        $this->dataMataKuliah = $dataMataKuliah;
    }

    public function build()
    {
        return $this->subject('Permohonan Data Mata Kuliah')
            ->view('emails.terima.data_mata_kuliah')
            ->with([
                'dataMataKuliah' => $this->dataMataKuliah,
                'user' => $this->dataMataKuliah->user,
            ]);
    }
}
