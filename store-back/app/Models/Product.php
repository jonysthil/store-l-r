<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $table      = 'products';
    protected $primaryKey = 'prod_id';
    protected $fillable   = ['prod_name'];
    //protected $guarded    = ['prod_id'];
    public $timestamps    = false;

    public function scopeGetAll($query) {
        return $query->where('prod_status', 1)->orderBy('prod_name', 'asc')->get();
    }

    public function scopeInsertData($query, $data) {
        return $query->insertGetId($data);
    }

    public function scopeGetData($query, $prod_id) {
        return $query->select('*')->where('prod_id', $prod_id)->first();
    }

    public function scopeUpdateData($query, $prod_id, $data) {
        return $query->where('prod_id',$prod_id)->update($data);
    }

    public function scopeDeleteData($query, $prod_id) {
        return $query->where('prod_id', $prod_id)->delete();
    }
    
}
