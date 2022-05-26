<?php

namespace App\Models;

class Supplier
{
    public $suppliers = ['supplierA', 'supplierB'];
    public $supplierA = [
        'dental_floss' => ['1' => 9, '20' => 160],
        'ibuprofen' => ['1' => 5, '10' => 48]
    ];
    public $supplierB = [
        'dental_floss' => ['1' => 8, '10' => 71],
        'ibuprofen' => ['1' => 6, '5' => 25, '100' => 410]
    ];
    public function getProductsSupplier($supplier)
    {
        return $this->{$supplier};
    }
    public function getSuppliers()
    {
        return $this->suppliers;
    }
    public function getProducts()
    {
        $products = [];
        foreach ($this->getSuppliers() as $value) {
            foreach (array_keys($this->getProductsSupplier($value)) as $key => $item) {
                if (!in_array($item, $products)) {
                    $products[] = $item;
                }
            }
        }
        return $products;
    }
}
