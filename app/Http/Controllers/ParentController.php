<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use App\Services\ParentService;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    protected $parentService;

    public function __construct(ParentService $parentService)
    {
        $this->parentService = $parentService;
    }

    /**
     * Display the index page with parents list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // If AJAX request, return parents data
            return $this->parentService->getAllParents();
        }

        // If non-AJAX request, load the index view with schools data
        $ecoles = Ecole::select('id', 'name')->get();
        return view('parents.index', compact('ecoles'));
    }

    /**
     * Display details of a specific parent.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function viewDetails(Request $request)
    {
        // Retrieve and display parent details
        return $this->parentService->viewDetails($request);
    }
}
