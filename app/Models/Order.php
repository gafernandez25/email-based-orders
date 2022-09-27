<?php

namespace App\Models;

class Order implements \JsonSerializable
{
    private string $subject = "";
    private string $senderName = "";
    private string $senderEmail = "";
    private string $textBody = "";
    private string $htmlBody = "";
    private string $date;

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSubject(string $subject): Order
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSenderName(string $senderName): Order
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function getSenderName(): string
    {
        return $this->senderName;
    }

    public function setSenderEmail(string $senderEmail): Order
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    public function getSenderEmail(): string
    {
        return $this->senderEmail;
    }

    public function setTextBody(string $textBody): Order
    {
        $this->textBody = $textBody;
        return $this;
    }

    public function getTextBody(): string
    {
        return $this->textBody;
    }

    public function setHtmlBody(string $htmlBody): Order
    {
        $this->htmlBody = $htmlBody;
        return $this;
    }

    public function getHtmlBody(): string
    {
        return $this->htmlBody;
    }

    public function setDate(string $date): Order
    {
        $this->date = $date;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
