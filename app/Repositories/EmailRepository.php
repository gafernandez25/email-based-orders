<?php

namespace App\Repositories;

use App\Dtos\EmailDto;
use App\Services\ImapConnection;
use Illuminate\Support\Facades\Config;
use stdClass;
use Webklex\PHPIMAP\Folder;

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

    /**
     * @return stdClass[]
     * @throws \Exception
     */
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

        return array_reverse(
            array_map(
                array(
                    new EmailDto(),
                    "formatMessage"
                ),
                $messages->toArray()
            )
        );
    }

    public function getMessageById(int $id): stdClass
    {
        try {
            $message = $this->folder->messages()->getMessageByUid($id);
        } catch (\Exception $e) {
            throw new \Exception("Email could not be read");
        }
        return (new EmailDto())->formatMessage($message);
    }
}
