<?php

namespace Tests\Unit;

use App\Repositories\EmailRepository;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;
use stdClass;

class OrderServiceTest extends TestCase
{
    public function testGetPaginatedOrdersReturnsOrderCollection()
    {
        $mockEmailRepository = $this->createMock(EmailRepository::class);

        $obj = new stdClass();
        $obj->id = 1;
        $obj->subject = "fake subject";
        $obj->senderName = "fake sender name";
        $obj->senderEmail = "fake sender email";
        $obj->textBody = "fake body";
        $obj->htmlBody = "fake html";
        $obj->date = "2022-02-02 12:00:00";

        $mockEmailRepository->method("getPaginated")->willReturn([$obj]);

        $orders = (new OrderService($mockEmailRepository))->getPaginatedOrders();

        $this->assertCount(1, $orders->getOrders());
        $this->assertEquals(1, $orders->getOrders()->first()->getId());
    }
}
