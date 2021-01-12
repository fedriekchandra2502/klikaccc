<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trx_po_d extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'trx_po_d';
    protected $fillable = [
        'po_h_id',
        'po_item_id',
        'po_item_qty',
        'po_item_price',
        'po_item_cost'
    ];

    public function POH() {
        return $this->belongsTo(trx_po_h::class ,'po_h_id');
    }

    public function item() {
        return $this->belongsTo(ms_item::class ,'po_item_id');
    }
}
