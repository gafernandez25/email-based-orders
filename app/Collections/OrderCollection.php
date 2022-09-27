<?php

namespace App\Collections;

use App\Models\Order;
use Illuminate\Support\Collection;

class OrderCollection implements \JsonSerializable
{
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new Collection();
    }

    public function addOrder(Order $order): void
    {
        $this->orders->add($order);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
