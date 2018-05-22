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

class EmailConversation extends Conversation
{
    protected $email;

    protected $con;

    protected $class;

    public function askEmail()
    {
        $con = connect_db();
        $conv = get_class($this);
        $query = "SELECT text_conversation, next_conv FROM conversation WHERE conv='$conv'";
        $result = $con->query($query);
        if($col = $result->fetch(PDO::FETCH_NUM)){
            $this->class = new $col[1]();
            $this->ask($col[0], function (Answer $answer) {
                $this->email = $answer->getText();
                $this->bot->startConversation($this->class);
            });
        }
    }

    public function run()
    {
        $this->askEmail();
    }
}