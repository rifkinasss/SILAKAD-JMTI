<?php

namespace App\Mail\Terima;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RekomendasiLombaTerima extends Mailable
{
    use Queueable, SerializesModels;

    public $rekomendasilomba;

    public function __construct($rekomendasilomba)
    {
        $this->rekomendasilomba = $rekomendasilomba;
    }

    public function build()
    {
        return $this->subject('Rekomendasi Lomba')
            ->view('emails.terima.rekomendasi_lomba')
            ->with([
                'rekomendasilomba' => $this->rekomendasilomba,
                'user' => $this->rekomendasilomba->user,
            ]);
    }
}
