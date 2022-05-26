<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Supplier;

class Controller extends BaseController
{
    public $suppliers = ['supplierA', 'supplierB'];
    public $supplierA;
    public $supplierB;
    public $products;
    public function __construct()
    {
        $supplierModel = new Supplier;
        $this->supplierA = $supplierModel->getSupplier('supplierA');
        $this->supplierB = $supplierModel->getSupplier('supplierB');
        $this->products = array_unique(array_merge(array_keys($this->supplierA), array_keys($this->supplierB)));
    }
}
