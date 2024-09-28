<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailKetTelahTA extends Mailable
{
    use Queueable, SerializesModels;

    public $KetTelahTA;

    public function __construct($KetTelahTA)
    {
        $this->KetTelahTA = $KetTelahTA;
    }

    public function build()
    {
        return $this->subject('Keterangan Telah Tugas Akhir')
            ->view('emails.confirm_demand.ket_telah_TA')
            ->with([
                'KetTe$KetTelahTA' => $this->KetTelahTA,
                'user' => $this->KetTelahTA->user,
            ]);
    }
}
