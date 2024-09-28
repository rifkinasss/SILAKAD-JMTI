<?php

namespace App\Mail\Tolak;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RekomendasiLombaTolak extends Mailable
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
            ->view('emails.confirm_demand.rekomendasi_lomba')
            ->with([
                'rekomendasilomba' => $this->rekomendasilomba,
                'user' => $this->rekomendasilomba->user,
                'keterangan' => $this->rekomendasilomba->keterangan,
            ]);
    }
}
