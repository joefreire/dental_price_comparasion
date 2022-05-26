<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $suppliers = ['supplierA','supplierB'];
    public $supplierA;
    public $supplierB;
    public $products;
    public function __construct()
    {
        $this->supplierA = [
            'dental_floss' => ['1' => 9, '20' => 160],
            'ibuprofen' => ['1' => 5, '10' => 48]
        ];
        $this->supplierB = [
            'dental_floss' => ['1' => 8, '10' => 71],
            'ibuprofen' => ['1' => 6, '5' => 25, '100'=>410]
        ];
        $this->products = array_unique(array_merge(array_keys($this->supplierA),array_keys($this->supplierB)));
    }
}
