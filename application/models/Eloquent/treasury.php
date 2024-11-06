<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Treasury extends Eloquent {

    public $table = 'master_treasury';

    public $guarded = ['id'];

}