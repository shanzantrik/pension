<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PFAMILYD extends Eloquent {

    public $table = 'pensioner_family_details';

    public function pensioner_personal_details()
    {
    	return $this->belongsTo('PPERSONALD', 'serial_no', 'serial_no');
    }
}