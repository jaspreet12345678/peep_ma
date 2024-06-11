<?php

namespace App\Services;

use App\Models\Enfant;
use App\Models\OrderEnfantDetails;
use App\Models\OrderMaster;
use App\Models\Parents;
use App\Models\ParentView;
use Carbon\Carbon;

class ParentService
{

    public function fetchLatestOrderMaster($parentId)
    {
        $orderMaster = OrderMaster::where('parent_id', $parentId)
            ->whereIn('status', [1, 5, 6])
            ->latest()
            ->first();

        return $orderMaster;
    }

    public function fetchAllOrderMaster($parentId)
    {
        $orders = OrderMaster::where('parent_id', $parentId)
            ->where('status', '>', 0)
            ->get();

        return $orders;
    }

    public function fetchEnfants($parentId)
    {
        $enfants = Enfant::where('parent_id', $parentId)
            ->with('ecole', 'class')
            ->get();
        return $enfants;
    }

    public function fetchOrderEnfantDetails($orderId)
    {
        $order_enfant_details = OrderEnfantDetails::where('order_id', $orderId)->get();
        return $order_enfant_details;
    }

    public function fetchParent()
    {
        $parents = Parents::where('is_updated', 0)->get();
        return $parents;
    }
    /**
     * Retrieve all parents along with their related information.
     *
     * This function fetches all parents from the database and gathers
     * various related details such as their latest orders, associated
     * children, membership status, insured status, and school/class names.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllParents()
    {
        $query = ParentView::query();

        return datatables()::of($query)
        ->editColumn('last_payment_date', function ($parent) {
            return isset($parent['last_payment_date']) ? Carbon::parse($parent['last_payment_date'])->format('d-M-Y') : null;
        })
        ->filterColumn('last_payment_date', function ($query, $keyword) {
            $this->filterDateColumn($query, $keyword, 'last_payment_date', 'parent_view');
        })
        ->toJson();
    }

    public function filterDateColumn($query, $keyword, $column, $table)
    {
        // Define an array to map month abbreviations to their numerical equivalents
        $months = [
            'Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04',
            'May' => '05', 'Jun' => '06', 'Jul' => '07', 'Aug' => '08',
            'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12'
        ];

        // Split the keyword into parts
        $parts = explode('-', $keyword);

        // Initialize searchDate
        $searchDate = '';

        // If the keyword contains day, month, and year
        if (count($parts) === 3) {
            $day = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
            $month = isset($months[$parts[1]]) ? $months[$parts[1]] : null;
            $year = $parts[2];

            // Construct the search date in the format Y-m-d
            $searchDate = $month ? "$year-$month-$day" : '';
        }

        // If search date is not empty, perform the search
        if (!empty($searchDate)) {
            $query->whereDate($table . '.' . $column, $searchDate);
        }
    }

    public function getParentViewData()
    {
        $parents = $this->fetchParent();
        $data = []; // Initialize $data as an empty array

        foreach ($parents as $parent) {
            $orderMaster = $this->fetchLatestOrderMaster($parent->id);

            $orders = $this->fetchAllOrderMaster($parent->id);

            $enfants = $this->fetchEnfants($parent->id);

            $schoolNames = $enfants->filter(fn ($enfant) => $enfant->ecole)
                ->pluck('ecole.name')
                ->toArray();

            $schoolIds = $enfants->filter(fn ($enfant) => $enfant->ecole)
                ->pluck('ecole.id')
                ->toArray();

            $classNames = $enfants->filter(fn ($enfant) => $enfant->class)
                ->pluck('class.name')
                ->toArray();

            $classIds = $enfants->filter(fn ($enfant) => $enfant->class)
                ->pluck('class.name')
                ->toArray();

            $schoolNamesString = implode(', ', $schoolNames);
            $schoolId = implode(', ', $schoolIds);
            $classId = implode(', ', $classIds);
            $classNamesString = implode(', ', $classNames);

            $member_adherent = "AdhNo";
            $insured_child = "AssNo";
            $membership_number = null;

            foreach ($orders as $order) {
                if (!empty($order->adhesion)) {
                    $member_adherent = "AdhYes";
                }

                $order_enfant_details = $this->fetchOrderEnfantDetails($order->id);
                if (!$order_enfant_details->isEmpty()) {
                    $insured_child = 'AssYes';
                }
            }

            if ($orderMaster) {
                $membership_number = $orderMaster->code;
            }

            $data[] = [
                'parent_id' => $parent->id,
                'last_payment_date' => $orderMaster ? $orderMaster->created_at : null,
                'membership_number' => $membership_number ?? 0,
                'parent_name' => $parent->nom . ' ' . $parent->prenom,
                'parent_email' => $parent->email,
                'parent_telephone' => $parent->telephone,
                'password' => $parent->password,
                'role' => $parent->role,
                'number_child' => $enfants->count(),
                'insured_child' => $insured_child,
                'member_adherent' => $member_adherent,
                'school' => $schoolNamesString,
                'school_ids' => $schoolId,
                'class_names' => $classNamesString,
                'class_ids' => $classId
            ];
        }

        return $data;
    }

    public function insertParentData()
    {
        $allParentData =  $this->getParentViewData();

        foreach ($allParentData as $parent) {
            ParentView::create($parent);
            $parent = Parents::findOrFAil($parent['parent_id']);
            $parent->is_updated = false;
            $parent->save();
        }
    }

    public function viewDetails($request)
    {
        // Find the parent by email and eager load children
        $parent = Parents::where('email', $request->rowDataEmail)->with(['enfants'])->first();
        if ($parent) {
            // Render the view with parent details
            return view('parents.viewDetail', compact('parent'));
        }
    }
}
