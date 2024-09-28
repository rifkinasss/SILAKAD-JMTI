<?php

namespace App\Mail\Terima;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KetTelahTATerima extends Mailable
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
            ->view('emails.terima.telah_tugas_akhir')
            ->with([
                'telahTA' => $this->telahTA,
                'user' => $this->telahTA->user,
            ]);
    }
}
