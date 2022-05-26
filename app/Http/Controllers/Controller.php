<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Supplier;

class Controller extends BaseController
{
    public $suppliers;
    public $supplierA;
    public $supplierB;
    public $products;
    public function __construct()
    {
        $supplierModel = new Supplier;
        $this->supplierA = $supplierModel->getProductsSupplier('supplierA');
        $this->supplierB = $supplierModel->getProductsSupplier('supplierB');
        $this->suppliers = $supplierModel->getSuppliers();
        $this->products = $supplierModel->getProducts();
    }
}
