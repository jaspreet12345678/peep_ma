<?php

namespace App\Services;

use App\Models\Enfant;
use App\Models\EnfantView;
use App\Models\OrderEnfantDetails;
use App\Models\OrderMaster;
use App\Models\Parents;

class ChildsService
{

    public function fetchEnfants()
    {
        return Enfant::with(['ecole', 'class'])->where('is_updated', 1)->get();
    }

    public function fetchParent($parentId)
    {
        $parent = Parents::findOrFail($parentId);
        return $parent;
    }

    public function fetchOrderMaster($parentId)
    {
        $order = OrderMaster::where('parent_id',$parentId)->latest()->first();
        return $order;
    }

    public function fetchOrderEnfantDetails($enfantId)
    {
        $order = OrderEnfantDetails::where('enfant_id',$enfantId)->latest()->first();
        return $order;
    }


    public function getAllChildData(){
        $query = EnfantView::query();
        return datatables()::of($query)
        ->toJson();
    }

    public function getChildViewData()
    {
        $enfants = $this->fetchEnfants();
        $data = []; // Initialize $data as an empty array

        foreach ($enfants as $enfant) {
            $parent = $this->fetchParent($enfant->parent_id);
            $order = $this->fetchOrderMaster($enfant->parent_id);
            $order_enfant_details = $this->fetchOrderEnfantDetails($enfant->id);

            $schoolName = $enfant->ecole->name ?? null;

            $schoolId = $enfant->ecole->id ?? 0;

            $className = $enfant->class->name ?? null;

            $classId = $enfant->class->id ?? 0;

            $schoolNamesString = $schoolName;
            $schoolId = $schoolId;
            $classId = $classId;
            $classNamesString = $className;

            $data[] = [
                'enfant_id' => $enfant->id,
                'nom' => $enfant->nom,
                'prenom' => $enfant->prenom,
                'ecole_name' => $schoolNamesString,
                'ecole_id' => $schoolId,
                'class_name' => $classNamesString,
                'class_id' => $classId,
                'parent_id' => $parent->id,
                'parent_nom' => $parent->nom,
                'parent_prenom' => $parent->prenom,
                'parent_email' => $parent->email,
                'dob'=> $enfant->dob,
                'parent_telephone' => $parent->telephone,
                'assurance_scolaire' => $order_enfant_details->school_insurance ?? 0,
                'assurance_frais' => $order_enfant_details->tution_fee_insurance ?? 0,
                'attestation_num' => $order->code ?? 0,
                'adhesion' => $order->adhesion ?? 0,
                'contributions' => $order->contribution ?? 0,
                'last_insurance_paid' => $order->created_at ?? 0,
            ];
        }

        return $data;
    }

    public function insertChildData()
    {
        $allChildData =  $this->getChildViewData();

        foreach ($allChildData as $child) {
            EnfantView::create($child);
            $child = Enfant::findOrFAil($child['enfant_id']);
            $child->is_updated = false;
            $child->save();
        }
    }

    public function viewDetails($request)
    {
        // Find the parent by email and eager load children
        $parentDetail = EnfantView::findOrFail($request->rowDataId);
        $childDetail = EnfantView::where('parent_id',$request->parent_id)->get();
        if ($childDetail) {
            // Render the view with parent details
            return view('childs.viewDetail', compact('childDetail','parentDetail'));
        }
    }

}
