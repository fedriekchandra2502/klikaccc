<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ms_item;
use App\Models\trx_po_d;
use App\Models\trx_po_h;
use Carbon\Carbon;

class POController extends Controller
{
    public function showAllPO() {
        $po = trx_po_h::paginate(10);

        return response()->json(['data' => $po]);
    }

    public function createPO(Request $request) {
        $last_id = trx_po_h::latest()->first();
        if(!$last_id) {
            $id = '0001';
        } else {
            $previd = $last_id->id;
            $id = str_pad($previd,4,'0',STR_PAD_LEFT);
        }
        $date = Carbon::now()->format('Ym');
        $po_number = $date . '-' . $id;
        // foreach() {

        // }
        $newPO = trx_po_h::create([
            'po_number' => $po_number,
            'po_date' => Carbon::now(),
            'po_price_total' => '',
            'Po_cost_total' => '',
        ]);


    }

    public function updatePO(Request $request, $id) {

    }

    public function deletePO(Request $request, $id) {

    }
}
