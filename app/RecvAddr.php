<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class RecvAddr extends Model {

    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recv_addrs';
    public  function user()
    {
        $this->belongsTo('xesc/User');
    }

}
