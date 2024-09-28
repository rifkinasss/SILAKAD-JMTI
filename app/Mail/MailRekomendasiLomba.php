<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRekomendasiLomba extends Mailable
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
            ]);
    }
}
