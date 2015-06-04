<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

	//

    protected $table = 'carts';

    public  function  dishes()
    {
        return $this->belongsToMany('xesc\dishes','cart_dishes_mid');
    }
    public  function  user()
    {
        return $this->belongsTo('xesc\user');
    }

}
