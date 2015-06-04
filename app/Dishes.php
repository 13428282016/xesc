<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishes extends Model {

	//
    const STATUS_ONLINE=1;
    const  STATUS_OFFLINE=2;

    use SoftDeletes;
    protected $table = 'dishes';
    public function  carts()
    {
        return $this->belongsToMany('xesc\cart','cart_dishes_mid');
    }


}
