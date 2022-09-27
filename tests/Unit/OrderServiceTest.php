<?php

namespace Tests\Unit;

use App\Repositories\EmailRepository;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    public function testGetPaginatedOrdersReturnsOrderCollection()
    {
        $mockEmailRepository = $this->createMock(EmailRepository::class);
        $mockEmailRepository->method("getPaginated")->willReturn([
            [
                "id" => 1,
                "subject" => "fake subject",
                "senderName" => "fake sender name",
                "senderEmail" => "fake sender email",
                "textBody" => "fake body",
                "htmlBody" => "fake html",
                "date" => "2022-02-02 12:00:00"
            ],
            [
                "id" => 2,
                "subject" => "fake subject",
                "senderName" => "fake sender name",
                "senderEmail" => "fake sender email",
                "textBody" => "fake body",
                "htmlBody" => "fake html",
                "date" => "2022-02-02 12:00:00"
            ],
            [
                "id" => 3,
                "subject" => "fake subject",
                "senderName" => "fake sender name",
                "senderEmail" => "fake sender email",
                "textBody" => "fake body",
                "htmlBody" => "fake html",
                "date" => "2022-02-02 12:00:00"
            ],
        ]);

        $orders = (new OrderService($mockEmailRepository))->getPaginatedOrders();

        $this->assertCount(3, $orders->getOrders());
        $this->assertEquals(1, $orders->getOrders()->first()->getId());
    }
}
