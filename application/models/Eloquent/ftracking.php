<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class FTracking extends Eloquent {

    public $table = 'file_tracking_details';

    public $guarded = ['serial_no'];

}