<?php

namespace App\Models;

class Customer extends \Leaf\Model{

    protected $table = 'customers';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'FirstName',
        'LastName',
        'City',
        'Email'
    ];
}
