<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS-ROG
 * Date: 19/05/2018
 * Time: 13:47
 */

require_once realpath($_SERVER["DOCUMENT_ROOT"]). '\botman2\Lapor-Chatbot-dev\mysql\connect_db.php';

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class LaporanConversation extends Conversation
{
    protected $laporan;

    public function askLaporan()
    {
        $con = connect_db();
        $conv = get_class($this);
        $query = "SELECT text_conversation, next_conv FROM conversation WHERE conv='$conv'";
        $result = $con->query($query);
        if($col = $result->fetch(PDO::FETCH_NUM)){
            $this->ask($col[0], function (Answer $answer) {
                $this->laporan = $answer->getText();
                $this->say('Baik, laporan sudah kami terima. Tracking ID kamu adalah 1234567. Harap simpan Tracking ID untuk pengecekan laporan lebih lanjut, Terima Kasih!');
            });
        }
    }

    public function run()
    {
        $this->askLaporan();
    }
}