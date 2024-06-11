<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    // Constructor to inject OrderService dependency
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // Method to handle index page rendering or AJAX request for orders
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Return the list of orders using the OrderService
            return $this->orderService->getOrders($request);
        }
        // Render the index view
        return view('orders.index');
    }

    // Method to update order status
    public function updateOrderStatus(Request $request)
    {
        // Update order status using OrderService
        return $this->orderService->updateOrderStatus($request);
    }

    // Method to view order details
    public function viewDetails(Request $request)
    {
        // View order details using OrderService
        return $this->orderService->viewDetails($request);
    }

    // Method to generate order certificate
    public function generateOrderCertificate(Request $request)
    {
        // Extract the ID from request and generate PDF using OrderService
        $id = $request->rowDataId;
        $this->orderService->generatePdf($id);
        // Return success JSON response
        return response()->json(['success' => true]);
    }

    // Method to download PDF of an order
    public function downloadPdf($id)
    {
        // Download PDF using OrderService
        $this->orderService->downloadPdfService($id);
    }
}
