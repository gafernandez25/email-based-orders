<?php

namespace App\Repositories;

use App\Services\ImapConnection;
use Illuminate\Support\Facades\Config;
use Webklex\PHPIMAP\Folder;
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

        return $this->formatMessages($messages);
    }

    public function formatMessages(MessageCollection $messages): array
    {
        return array_reverse(
            array_map(function ($message) {
                $fromData = $message->getFrom()[0];
                return [
                    "id" => $message->getUid(),
                    "subject" => $message->getSubject(),
                    "senderName" => $fromData->personal,
                    "senderEmail" => $fromData->mail,
                    "textBody" => ($message->hasTextBody()) ? $message->getTextBody() : "",
                    "htmlBody" => ($message->hasHtmlBody()) ? $message->getHTMLBody() : "",
                    "date" => $message->getDate()[0]->format("Y-m-d H:i:s")
                ];
            }, $messages->toArray())
        );
    }
}
