<?php

namespace App\Services;

use App\Collections\OrderCollection;
use App\Models\Order;
use App\Repositories\EmailRepository;

class OrderService
{
    public function __construct(
        private EmailRepository $emailRepository
    ) {
    }

    public function getCountOrders(): int
    {
        return $this->emailRepository->getCount();
    }

    public function getPaginatedOrders(
        int $quantity = 10,
        int $page = 1,
        bool $fetchBody = true
    ): OrderCollection {
        $emails = $this->emailRepository->getPaginated($quantity, $page, $fetchBody);

        $orders = new OrderCollection();

        foreach ($emails as $email) {
            $order = (new Order($email->id))
                ->setSubject($email->subject)
                ->setSenderName($email->senderName)
                ->setSenderEmail($email->senderEmail)
                ->setTextBody($email->textBody)
                ->setHtmlBody($email->htmlBody)
                ->setDate($email->date);

            $orders->addOrder($order);
        }

        return $orders;
    }

    public function getOrderById(int $id): Order
    {
        $email = $this->emailRepository->getMessageById($id);

        return (new Order($email->id))
            ->setSubject($email->subject)
            ->setSenderName($email->senderName)
            ->setSenderEmail($email->senderEmail)
            ->setTextBody($email->textBody)
            ->setHtmlBody($email->htmlBody)
            ->setDate($email->date);
    }
}
