<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Webklex\PHPIMAP\Client;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Support\MessageCollection;

class ImapConnection
{
    private array $connectionData;
    private Client $client;

    public function __construct()
    {
        $this->connectionData = [
            'host' => Config::get("mail.mailers.imap.host"),
            'port' => Config::get("mail.mailers.imap.port"),
            'encryption' => Config::get("mail.mailers.imap.encryption"),
            'validate_cert' => Config::get("mail.mailers.imap.validate_cert"),
            'username' => Config::get("mail.mailers.imap.username"),
            'password' => Config::get("mail.mailers.imap.password"),
            'protocol' => Config::get("mail.mailers.imap.protocol")
        ];

        $cm = new ClientManager();
        $this->client = $cm->make($this->connectionData);
        $this->client->connect();
    }

    public function getFolder(string $folderName): Folder
    {
        return $this->client->getFolderByName($folderName);
    }
}
