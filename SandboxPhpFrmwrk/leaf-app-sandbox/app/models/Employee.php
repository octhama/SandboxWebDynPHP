<?php

namespace App\Models;

class Employee extends \Leaf\Model {

    protected $table = 'employees';

    protected $primaryKey = 'EmployeeID';

    protected $fillable = [
        'FirstName',
        'LastName',
        'Title',
        'BirthDate',
        'Country',
    ];
}
