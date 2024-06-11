<?php

namespace App\Services;

use App\Mail\OrderDetailMail;
use App\Models\OrderHistory;
use App\Models\OrderMaster;
use App\Models\Parents;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class OrderService
{
    /**
     * Fetch and filter users based on the request parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function getOrders($request)
    {
        // Initialize a query builder for the User model
        $orders = OrderMaster::with(['enfants', 'transaction','user'])->select('order_master.*');

        return DataTables::of($orders)
            ->addColumn('parent_name', function ($order) {
                return $order->parent_nom . ' ' . $order->parent_prenom;
            })
            ->filterColumn('parent_name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('parent_nom', 'like', "%{$keyword}%")
                        ->orWhere('parent_prenom', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('total', function ($order) {
                return intval($order->total_amount) . ' Dhs';
            })
            ->filterColumn('total', function ($query, $keyword) {
                $query->where('total_amount', 'like', "%{$keyword}%");
            })
            ->addColumn('status', function ($order) {
                return $this->status($order->status);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status', 'like', "%{$keyword}%");
            })
            ->addColumn('utilisateur', function ($order) {
                return $order->user ? $order->user->name : ''; // Check if user exists to avoid errors
            })
            ->filterColumn('utilisateur', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('mode', function ($order) {
                return $order->mode;
            })
            ->filterColumn('mode', function ($query, $keyword) {
                $query->where('mode', 'like', "%{$keyword}%");
            })
            ->addColumn('cash_2023', function ($order) {
                // Assuming this is a specific logic for cash in 2023
                // return $order->total_amount - $order->adhesion - $order->contribution;
            })
            ->editColumn('date', function ($order) {
                return $order->created_at->format('d-M-Y');
            })
            ->filterColumn('date', function ($query, $keyword) {
                $query->where('created_at', 'like', "%{$keyword}%");
            })
            ->orderColumn('status', function ($query, $order) {
                $query->orderBy('status', $order);
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('created_at', $order);
            })
            ->make(true);

    }

    // public function getOrders($request)
    // {
    //     // Initialize a query builder for the User model
    //     $orders = OrderMaster::with(['enfants', 'transaction','user'])->select('order_master.*');

    //     return DataTables::of($orders)
    //         // Add columns and apply filters
    //         ->addColumn('parent_name', function ($order) {
    //             return $order->parent_nom . ' ' . $order->parent_prenom;
    //         })
    //         ->filterColumn('parent_name', function ($query, $keyword) {
    //             $query->where(function ($q) use ($keyword) {
    //                 $q->where('parent_nom', 'like', "%{$keyword}%")
    //                   ->orWhere('parent_prenom', 'like', "%{$keyword}%");
    //             });
    //         })
    //         ->addColumn('parent_tel', function ($order) {
    //             return $order->parent_telephone;
    //         })
    //         ->filterColumn('parent_tel', function ($query, $keyword) {
    //             $query->where('parent_telephone', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('parent_email', function ($order) {
    //             return $order->parent_email;
    //         })
    //         ->filterColumn('parent_email', function ($query, $keyword) {
    //             $query->where('parent_email', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('num_commande', function ($order) {
    //             return $order->code;
    //         })
    //         ->filterColumn('num_commande', function ($query, $keyword) {
    //             $query->where('code', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('total', function ($order) {
    //             return intval($order->total_amount) . ' Dhs';
    //         })
    //         ->filterColumn('total', function ($query, $keyword) {
    //             $query->where('total_amount', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('status', function ($order) {
    //             return $this->status($order->status);
    //         })
    //         ->filterColumn('status', function ($query, $keyword) {
    //             $query->where('status', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('utilisateur', function ($order) {
    //             return $order->user ? $order->user->name : ''; // Check if user exists to avoid errors
    //         })
    //         ->filterColumn('utilisateur', function ($query, $keyword) {
    //             $query->whereHas('user', function ($q) use ($keyword) {
    //                 $q->where('name', 'like', "%{$keyword}%");
    //             });
    //         })
    //         ->addColumn('mode', function ($order) {
    //             return $order->mode;
    //         })
    //         ->filterColumn('mode', function ($query, $keyword) {
    //             $query->where('mode', 'like', "%{$keyword}%");
    //         })
    //         ->addColumn('cash_2023', function ($order) {
    //             // Assuming this is a specific logic for cash in 2023
    //             // return $order->total_amount - $order->adhesion - $order->contribution;
    //         })
    //         ->addColumn('date', function ($order) {
    //             return $order->created_at->format('Y-m-d');
    //         })
    //         ->filterColumn('date', function ($query, $keyword) {
    //             $query->where('created_at', 'like', "%{$keyword}%");
    //         })
    //         ->orderColumn('total', function ($query, $order) {
    //             $query->orderBy('total_amount', $order);
    //         })
    //         ->orderColumn('status', function ($query, $order) {
    //             $query->orderBy('status', $order);
    //         })
    //         ->orderColumn('date', function ($query, $order) {
    //             $query->orderBy('created_at', $order);
    //         })
    //         ->make(true);
    // }

    public function viewDetails($request){
        // Find the order
        $order = OrderMaster::findOrFail($request->rowDataId);

        // Check if the order exists
        if ($order) {
            // Retrieve the latest order history
            $orderHistory = OrderHistory::where('order_id', $request->rowDataId)->latest()->first();
            // Render view with order details and history
            return view('orders.viewDetail', compact('order', 'orderHistory'));
        }
    }

    public function updateOrderStatus($request){
        // Get the authenticated user
        $user = Auth::user();
        $user_id = $user->id;

        // Create a new OrderHistory record
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $request->order_id;
        $orderHistory->status = $request->status;
        $orderHistory->comment = $request->comment;
        $orderHistory->user_id = $user_id;
        $orderHistory->save();

        // Update the order status
        OrderMaster::whereId($request->order_id)->update([
            'status' => $request->status,
            'user_id' => $user_id,
        ]);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully.',
        ]);
    }

    public function status($status_id)
    {
        $status = "";
        switch ($status_id) {
            case 0:
                $status = "Non Payé";
                break;
            case 1:
                $status = "Payé";
                break;
            case 2:
                $status = "Annulé";
                break;
            case 3:
                $status = "Modifier";
                break;
            case 4:
                $status = "Rembourser";
                break;
            case 5:
                $status = "Payée Cash";
                break;
            case 6:
                $status = "Encaissé";
                break;
        }
        return $status;
    }

    public function generatePdf($id)
    {
        // Find the order
        $order = OrderMaster::findOrFail($id);

        // Generate HTML for PDF based on order mode
        $data['order'] = $order;
        if ($order->mode == 'invite') {
            $html = view('orders.pdfs.pdf', $data)->render();
        } else {
            $html = view('orders.pdfs.pdf1', $data)->render();
        }

        // Initialize Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $pdf = $dompdf->output();
        $file_location = public_path('uploads/pdf/' . $order->code . '.pdf');

        // Ensure the directory exists
        $directory = dirname($file_location);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save PDF to file location
        file_put_contents($file_location, $pdf);

        // Send email with PDF attachment
        $url = url($file_location);
        $responsable['url'] = $url;
        $parent = Parents::findOrFail($id);
        // $to_email = $parent->email;
        $to_email = "jaspreet.mangoit@gmail.com"; // Change to parent's email
        $subject = 'PDF Attestation Assurance N°' . $order->code;
        $message = view('emails.m5', $responsable)->render();
        Mail::to($to_email)->send(new OrderDetailMail($subject, $message, $file_location));
    }

    public function downloadPdfService($id)
    {
        try {
            $order = OrderMaster::findOrFail($id);

            $data['order'] = $order;

            $view = $order->mode == 'invite' ? 'orders.pdfs.pdf' : 'orders.pdfs.pdf1';

            $html = view($view, $data)->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');

            // Enable remote loading of images
            $options = $dompdf->getOptions();
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);

            $dompdf->render();

            return $dompdf->stream($order->code . '.pdf', ['Attachment' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
