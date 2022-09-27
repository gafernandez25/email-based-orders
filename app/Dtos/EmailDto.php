<?php

namespace App\Dtos;

use stdClass;
use Webklex\PHPIMAP\Message;

class EmailDto
{
    public function formatMessage(Message $message): stdClass
    {
        $obj = new stdClass();

        $fromData = $message->getFrom()[0];

        $obj->id = $message->getUid();
        $obj->subject = $message->getSubject();
        $obj->senderName = $fromData->personal;
        $obj->senderEmail = $fromData->mail;
        $obj->textBody = ($message->hasTextBody()) ? $message->getTextBody() : "";
        $obj->htmlBody = ($message->hasHtmlBody()) ? $message->getHTMLBody() : "";
        $obj->date = $message->getDate()[0]->format("Y-m-d H:i:s");

        return $obj;
    }
}
