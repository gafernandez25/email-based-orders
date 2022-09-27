<?php

namespace App\Repositories;

use App\Services\ImapConnection;
use Illuminate\Support\Facades\Config;
use stdClass;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Message;
use Webklex\PHPIMAP\Support\MessageCollection;

class EmailRepository
{
    private Folder $folder;

    public function __construct(private ImapConnection $imapConnection)
    {
        $this->folder = $this->imapConnection->getFolder(Config::get("imap.folder"));
    }

    public function getCount(): int
    {
        try {
            return $this->folder->messages()->all()->count();
        } catch (\Exception $e) {
            throw new \Exception("Emails could not be read");
        }
    }

    public function getPaginated(
        int $quantity = 10,
        int $page = 1,
        bool $fetchBody = true
    ): array {
        try {
            $messages = $this->folder->messages()
                ->all()
                ->limit($quantity, $page)
                ->fetchOrderDesc()
                ->setFetchBody($fetchBody)
                ->get();
        } catch (\Exception $e) {
            throw new \Exception("Emails could not be read");
        }

        return array_reverse(array_map(array($this, "formatMessage"), $messages->toArray()));
    }

    public function getMessageById(int $id): stdClass
    {
        try {
            $message = $this->folder->messages()->getMessageByUid($id);
        } catch (\Exception $e) {
            throw new \Exception("Email could not be read");
        }
        return $this->formatMessage($message);
    }

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
