<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PDetail extends Eloquent {

    public $table = 'pensioner_details';

    protected $guarded = ['id', 'case_no'];

    public $primaryKey = 'case_no';

    public $timestamps = false;

    public function pensioner_personal_details()
    {
    	return $this->belongsTo('PPERSONALD', 'case_no', 'case_no');
    }
}