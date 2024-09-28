<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDataMataKuliah extends Mailable
{
    use Queueable, SerializesModels;

    public $dataMataKuliah;

    public function __construct($dataMataKuliah)
    {
        $this->dataMataKuliah = $dataMataKuliah;
    }

    public function build()
    {
        return $this->subject('Permohonan Data Mata Kuliah')
            ->view('emails.confirm_demand.data_mata_kuliah')
            ->with([
                'dataMataKuliah' => $this->dataMataKuliah,
                'user' => $this->dataMataKuliah->user,
            ]);
    }
}
