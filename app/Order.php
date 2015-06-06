<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */

     const  STATUS_WAITTING_PAY=1;
      const  STATUS_DOING=2;
      const  STATUS_SHIPPING=3;
    const  STATUS_FINISHED=4;
    const  STATUS_CANCEL=10;




    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo('xesc\User');
    }
    public function dishes() {
        return $this->belongsToMany('xesc\Dishes','order_dishes_mid')->withPivot('dishes_amount','dishes_price');
    }

}
