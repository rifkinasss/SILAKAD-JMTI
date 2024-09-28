<?php

namespace App\Mail\Selesai;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RekomendasiLombaSelesai extends Mailable
{
    use Queueable, SerializesModels;

    public $lomba;

    public function __construct($lomba)
    {
        $this->lomba = $lomba;
    }

    public function build()
    {
        return $this->subject('Rekomendasi Lomba')
            ->view('emails.selesai.rekomendasi_lomba')
            ->with([
                'rekomendasilomba' => $this->lomba,
                'user' => $this->lomba->user,
            ]);
    }
}
