<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PTransfer extends Eloquent {

    public $table = 'pensioner_transfer';

    public function scopeOfType($query, $type)
    {
        return $query->whereType($type);
    }

    public function scopeIst($query, $id)
    {
    	return $query->whereIst($id);
    }

    public function scopeOrf($query, $id)
    {
    	return $query->whereOrf($id);
    }

    public function insideRecieveFrom()
    {
    	return $this->belongsTo('Treasury', 'irf');
    }

    public function insideSendTo()
    {
    	return $this->belongsTo('AccountantGeneral', 'ist');
    }

    public function outsideReceiveFrom()
    {
    	return $this->belongsTo('AccountantGeneral', 'orf');
    }

    public function outsideSendTo()
    {
    	return $this->belongsTo('Treasury', 'ost');
    }

    public function getCaseDatedAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['case_dated']));
    }

    public function getCpoDatedAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['cpo_dated']));
    }

    public function getCommOfPensionAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['comm_of_pension']));
    }

    public function getPaidUptoAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['paid_upto']));
    }

    public function getLetterDateAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['letter_date']));
    }
}