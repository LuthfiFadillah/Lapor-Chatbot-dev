<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS-ROG
 * Date: 19/05/2018
 * Time: 13:47
 */

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class LaporConversation extends Conversation
{
    protected $name;

    protected $email;

    protected $phone;

    protected $laporan;

    public function askName()
    {
        $this->ask('Halo! Nama kamu siapa?', function (Answer $answer) {
            $this->name = $answer->getText();
            $this->say('Selamat datang, ' . $this->name);
            $this->askPhone();
        });
    }

    public function askPhone()
    {
        $this->ask('tuliskan nomor telpon kamu!', function (Answer $answer) {
            $this->phone = $answer->getText();
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('tuliskan email kamu!', function (Answer $answer) {
            $this->email = $answer->getText();
            $this->askLaporan();
        });
    }

    public function askLaporan()
    {
        $this->ask('tuliskan Laporan kamu!', function (Answer $answer) {
            $this->laporan = $answer->getText();
            $this->say('Baik, laporan sudah kami terima. Tracking ID kamu adalah 1234567. Harap simpan Tracking ID untuk pengecekan laporan lebih lanjut, Terima Kasih!');
        });
    }

    public function run()
    {
        $this->askName();
    }
}