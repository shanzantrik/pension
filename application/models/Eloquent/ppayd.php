<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PPAYD extends Eloquent {

    public $table = 'pensioner_pay_details';

    public function pensioner_personal_details()
    {
    	return $this->belongsTo('PPERSONALD', 'serial_no', 'serial_no');
    }
}