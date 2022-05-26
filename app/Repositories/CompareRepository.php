<?php

namespace App\Repositories;

use App\Models\Supplier;

class CompareRepository
{
    public $suppliers;
    public $supplierA;
    public $supplierB;
    public $products;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
        $supplierModel = new Supplier;
        $this->supplierA = $supplierModel->getProductsSupplier('supplierA');
        $this->supplierB = $supplierModel->getProductsSupplier('supplierB');
        $this->suppliers = $supplierModel->getSuppliers();
        $this->products = $supplierModel->getProducts();
    }
    public function compare()
    {
        $total = [];
        foreach ($this->data as $product => $quantity) {
            $product = str_replace(' ', '_', strtolower(trim($product)));
            if (in_array($product, $this->products)) {
                foreach ($this->suppliers as $supplier) {
                    $total[$supplier][$product] = ['quantity' => $quantity, 'value' => 0];
                    foreach (array_reverse($this->{$supplier}[$product], true) as $supplierQuantity => $value) {
                        if ($total[$supplier][$product]['quantity'] >= $supplierQuantity && $total[$supplier][$product]['quantity'] > 0) {
                            $howMany = (int)($total[$supplier][$product]['quantity'] / $supplierQuantity);
                            $howMuch = ($howMany * $value);
                            $total[$supplier][$product]['quantity'] = $total[$supplier][$product]['quantity'] - ($howMany * $supplierQuantity);
                            $total[$supplier][$product]['value'] = $total[$supplier][$product]['value'] + $howMuch;
                        }
                    }
                }
            }
        }
        foreach ($this->suppliers as $supplier) {
            $total[$supplier]['total_pay'] = 0;
            foreach ($total[$supplier] as $key => $product) {
                if ($key != 'total_pay') {
                    $total[$supplier]['total_pay'] = $total[$supplier]['total_pay'] + $product['value'];
                }
            }
            if (!isset($total['result'])) {
                $total['result'] = $supplier;
            } elseif ($total['result'] < $total[$supplier]['total_pay']) {
                $total['result'] = $supplier;
            }
        }
        return $total;
    }
}
