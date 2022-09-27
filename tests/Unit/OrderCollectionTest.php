<?php
namespace Tests\Unit;

use App\Collections\OrderCollection;
use App\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderCollectionTest extends TestCase
{
    public function testAddOrders()
    {
        $orderCollection = new OrderCollection();

        for ($i = 1; $i <= 3; $i++) {
            $orderCollection->addOrder(new Order($i));
        }

        $orderCollectionSerialized = $orderCollection->jsonSerialize();

        $this->assertCount(3, $orderCollectionSerialized["orders"]);
        $this->assertInstanceOf(Order::class, $orderCollectionSerialized["orders"][0]);
    }

    public function testJsonSerializableReturnsOrdersArray()
    {
        $orderCollection = new OrderCollection();

        for ($i = 1; $i <= 3; $i++) {
            $orderCollection->addOrder(new Order($i));
        }

        $orderCollectionSerialized = $orderCollection->jsonSerialize();

        $this->assertIsArray($orderCollectionSerialized);
        $this->assertArrayHasKey("orders", $orderCollectionSerialized);
    }
}
