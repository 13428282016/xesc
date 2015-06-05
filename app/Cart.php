<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

	//

    protected $table = 'carts';

    public  function  dishes()
    {
        return $this->belongsToMany('xesc\dishes','cart_dishes_mid')->withPivot('dishes_amount');
    }
    public  function  user()
    {
        return $this->belongsTo('xesc\user');
    }

}
