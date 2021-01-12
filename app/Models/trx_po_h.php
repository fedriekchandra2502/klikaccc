<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trx_po_h extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'trx_po_h';
    protected $fillable = [
        'po_number',
        'po_date',
        'po_price_total',
        'po_cost_total'
    ];

    public function POD() {
        return $this->hasMany(trx_po_d::class, 'po_h_id');
    }
}
