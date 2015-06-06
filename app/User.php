<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function cart()
    {
        return  $this->hasOne('xesc\Cart');
    }
    public  function  recvAddrs()
    {
        return $this->hasMany('xesc\RecvAddr');
    }
    public  function  orders()
    {
        return $this->hasMany('xesc\Order','buyer_id');
    }
}
