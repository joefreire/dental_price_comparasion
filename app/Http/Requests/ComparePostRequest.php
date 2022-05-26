<?php

namespace App\Http\Requests;

use App\Models\Supplier;

class ComparePostRequest
{
    public $data;
    public $products;
    public function __construct($data)
    {
        $this->data = $data;
        $supplierModel = new Supplier;
        $this->products = $supplierModel->getProducts();
    }
    public function validate()
    {
        if (empty($this->data)) {
            return false;
        }
        foreach ($this->data as $product => $value) {
            $fomatedProduct = str_replace(' ', '_', strtolower(trim($product)));
            if (!in_array($fomatedProduct, $this->products)) {
                return false;
            }
        }
        return true;
    }
}
