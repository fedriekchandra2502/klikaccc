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

        $item_ids = $request->input('item_id');
        $po_price = [];
        $po_cost = [];
        $po_price_total = 0;
        $po_cost_total = 0;
        foreach($item_ids as $key => $item_id) {
            $item = ms_item::find($item_id);
            $po_price[$key] = $item->price * $request->input('item_qty')[$key];
            $po_cost[$key] = $item->cost * $request->input('item_qty')[$key];
            $po_price_total += $item->price * $request->input('item_qty')[$key];
            $po_cost_total += $item->cost * $request->input('item_qty')[$key];

        }

        $newPO = trx_po_h::create([
            'po_number' => $po_number,
            'po_date' => Carbon::now(),
            'po_price_total' => $po_price_total,
            'po_cost_total' => $po_cost_total,
        ]);

        foreach($item_ids as $key => $item_id) {
            $pod = trx_po_d::create([
                'po_h_id' => $newPO->id,
                'po_item_id' => $item_id,
                'po_item_qty' => $request->input('item_qty')[$key],
                'po_item_price' => $po_price[$key],
                'po_item_cost' => $po_cost[$key]
            ]);
        }
        return $newPO;
    }

    public function updatePO(Request $request, $id) {
        $item_ids = $request->input('item_id');
        $po_price = [];
        $po_cost = [];
        $po_price_total = 0;
        $po_cost_total = 0;
        foreach($item_ids as $key => $item_id) {
            $item = ms_item::find($item_id);
            $po_price[$key] = $item->price * $request->input('item_qty')[$key];
            $po_cost[$key] = $item->cost * $request->input('item_qty')[$key];
            $po_price_total += $item->price * $request->input('item_qty')[$key];
            $po_cost_total += $item->cost * $request->input('item_qty')[$key];
        }

        $updatePO = trx_po_h::where('id',$id)
                ->update([
                    'po_price_total' => $po_price_total,
                    'po_cost_total' => $po_cost_total,
                ]);

        foreach($item_ids as $key => $item_id) {
            $podUpdate = trx_po_d::where('po_h_id',$id)
                    ->where('po_item_id',$item_id)
                    ->update([
                        'po_item_qty' => $request->input('item_qty')[$key],
                        'po_item_price' => $po_price[$key],
                        'po_item_cost' => $po_cost[$key]
                    ]);
        }

        return $updatePO;
    }

    public function deletePO(Request $request, $id) {
        $po = trx_po_h::find($id);
        $po->delete();
        $pod = trx_po_d::where('po_h_id',$id)->delete();

        return $po;
    }
}
