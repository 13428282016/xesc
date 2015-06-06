<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class RecvAddr extends Model {

    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    const SEX_MAN=1;
    const SEX_WOMEN=2;
    protected $table = 'recv_addrs';
    protected $guarded =['id', 'user_id','is_default','sex'];
    public  function user()
    {
        $this->belongsTo('xesc\User');
    }

}
