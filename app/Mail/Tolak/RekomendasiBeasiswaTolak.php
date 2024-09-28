<?php

namespace App\Mail\Tolak;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RekomendasiBeasiswaTolak extends Mailable
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
            ->view('emails.tolak.rekomendasi_beasiswa')
            ->with([
                'rekomendasibeasiswa' => $this->rekomendasibeasiswa,
                'user' => $this->rekomendasibeasiswa->user,
                'keterangan' => $this->rekomendasibeasiswa->keterangan,
            ]);
    }
}
