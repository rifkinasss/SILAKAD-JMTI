<?php

namespace App\Mail\Terima;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RekomendasiBeasiswaTerima extends Mailable
{
    use Queueable, SerializesModels;

    public $rekomendasibeasiswa;

    public function __construct($rekomendasibeasiswa)
    {
        $this->rekomendasibeasiswa = $rekomendasibeasiswa;
    }

    public function build()
    {
        return $this->subject('Rekomendasi Beasiswa')
            ->view('emails.terima.rekomendasi_beasiswa')
            ->with([
                'rekomendasibeasiswa' => $this->rekomendasibeasiswa,
                'user' => $this->rekomendasibeasiswa->user,
            ]);
    }
}
