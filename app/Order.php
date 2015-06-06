<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */


    const STATUS_SUBMITTED=0;
     const  STATUS_WAITTING_PAY=1;

      const  STATUS_PAYED=2;
      const  STATUS_DOING=3;
      const  STATUS_SHIPPING=4;
    const  STATUS_FINISHED=5;
    const  STATUS_CANCEL=10;
    const STATUS_ALL=20;




    /** 餐到付款 */
    const PAYTYPE_ARRIVAL = 1;

    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo('xesc\User');
    }
    public function dishes() {
        return $this->belongsToMany('xesc\Dishes','order_dishes_mid')->withPivot('dishes_amount','dishes_price');
    }

    public static  function orderStatus($status) {
        switch($status) {
            case 1 :
                return "订单已提交";
            case 2 :
                return "小二已接单";
            case 3 :
                return "确认收餐";
            case 4 :
                return "已收餐";

        }
        return "";
    }

    public  static  function orderPaytype($payType) {

        switch($payType) {
            case 1:
                return "餐到付款";
        }

        return "";

    }

}
