<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function index(): View
    {
        return view("order.index");
    }

    public function indexDatatable(Request $request): JsonResponse
    {
        $offset = (int)($request->start / $request->length);
        $orderCollection = $this->orderService->getPaginatedOrders(
            $request->length,
            $offset,
            false
        );

        $countOrders = $this->orderService->getCountOrders();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $countOrders,
            'recordsFiltered' => $countOrders,
            'data' => $orderCollection->jsonSerialize()["orders"]
        ]);
    }

    public function show(int $id): View|RedirectResponse
    {
        try {
            $order = $this->orderService->getOrderById($id);
        } catch (Exception $e) {
            return redirect()->route("order.index")->with("error", $e->getMessage());
        }
        return view("order.show", compact("order"));
    }

    public function reply(int $id): View|RedirectResponse
    {
        try {
            $order = $this->orderService->getOrderById($id);
        } catch (Exception $e) {
            return redirect()->route("order.index")->with("error", $e->getMessage());
        }
        return view("order.reply", compact("order"));
    }

    public function sendReply(
        int $id,
        Request $request
    ): RedirectResponse {
        $order = $this->orderService->getOrderById($id);

        try {
            $this->orderService->sendReplyEmail($order, $request->body);
        } catch (Exception) {
            return back()->withInput()->with("error", "E-mail could not be sent");
        }

        return redirect()->route("order.index")->with("success", "E-mail sent");
    }
}
