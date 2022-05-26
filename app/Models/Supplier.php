<?php

namespace App\Models;

class Supplier
{
    public $supplierA = [
        'dental_floss' => ['1' => 9, '20' => 160],
        'ibuprofen' => ['1' => 5, '10' => 48]
    ];
    public $supplierB = [
        'dental_floss' => ['1' => 8, '10' => 71],
        'ibuprofen' => ['1' => 6, '5' => 25, '100' => 410]
    ];

    public function getSupplier($supplier)
    {
        return $this->{$supplier};
    }
}
