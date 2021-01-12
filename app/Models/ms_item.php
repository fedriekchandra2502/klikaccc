<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ms_item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ms_item';

    public function POD() {
        return $this->hasMany(trx_po_d::class ,'po_item_id');
    }
}
