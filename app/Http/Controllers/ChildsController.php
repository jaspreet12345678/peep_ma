<?php

namespace App\Http\Controllers;

use App\Services\ChildsService;
use Illuminate\Http\Request;

class ChildsController extends Controller
{
    protected $childsService;

    // Constructor to inject childService dependency
    public function __construct(ChildsService $childsService)
    {
        $this->childsService = $childsService;
    }

   public function index(Request $request)
   {

    if ($request->ajax()) {
        // Return the list of orders using the OrderService
        return $this->childsService->getAllChildData();
    }
    // Render the index view
    return view('childs.index');
   }

   public function viewDetails(Request $request)
   {
       // Retrieve and display parent details
       return $this->childsService->viewDetails($request);
   }
}
