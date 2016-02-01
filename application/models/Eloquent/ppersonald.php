<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PPERSONALD extends Eloquent {

    public $table = 'pensioner_personal_details';

    public function scopeClassOfPension($query, $type)
    {
        return $query->whereClassOfPension($type);
    }

    //relation
    public function pensioner_service_details()
    {
    	return $this->hasOne('PSERVICED', 'serial_no', 'serial_no');
    }

	public function pensioner_pay_details()
    {
    	return $this->hasOne('PPAYD', 'serial_no', 'serial_no');
    }

    public function pensioner_family_details()
    {
    	return $this->hasOne('PFAMILYD', 'serial_no', 'serial_no');
    }

    public function pensioner_files_details()
    {
    	return $this->hasOne('PFILESD', 'serial_no', 'serial_no');
    }

    public function pensioner_details()
    {
        return $this->hasOne('PDetail', 'case_no', 'case_no');
    }
}