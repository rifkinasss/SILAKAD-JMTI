<?php

namespace App\Mail\Proses;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KetTelahTAProses extends Mailable
{
    use Queueable, SerializesModels;

    public $telahTA;

    public function __construct($telahTA)
    {
        $this->telahTA = $telahTA;
    }

    public function build()
    {
        return $this->subject('Keterangan Telah Tugas Akhir')
            ->view('emails.proses.telah_tugas_akhir')
            ->with([
                'telahTA' => $this->telahTA,
                'user' => $this->telahTA->user,
            ]);
    }
}
