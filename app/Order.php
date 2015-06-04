<?php namespace xesc;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

	//
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo('xesc\User');
    }

}
