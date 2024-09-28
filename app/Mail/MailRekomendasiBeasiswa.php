<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRekomendasiBeasiswa extends Mailable
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
            ->view('emails.confirm_demand.rekomendasi_beasiswa')
            ->with([
                'rekomendasibeasiswa' => $this->rekomendasibeasiswa,
                'user' => $this->rekomendasibeasiswa->user,
            ]);
    }
}
