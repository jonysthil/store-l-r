<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    protected $table      = 'category';
    protected $primaryKey = 'cat_id';
    protected $fillable   = ['cat_name'];
    //protected $guarded    = ['cat_id'];
    public $timestamps    = false;

    public function scopeGetAll($query) {
        return $query->orderBy('cat_name', 'asc')->get();
    }

    public function scopeInsertData($query, $data) {
        return $query->insertGetId($data);
    }

    public function scopeGetData($query, $cat_id) {
        return $query->select('*')->where('cat_id', $cat_id)->first();
    }

    public function scopeUpdateData($query, $cat_id, $data) {
        return $query->where('cat_id',$cat_id)->update($data);
    }

    public function scopeDeleteData($query, $cat_id) {
        return $query->where('cat_id', $cat_id)->delete();
    }
    
}
