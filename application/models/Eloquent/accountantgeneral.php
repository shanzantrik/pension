<?php

require_once('connection.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class AccountantGeneral extends Eloquent {

    public $table = 'master_accountant_general';

    public $guarded = ['id'];

}