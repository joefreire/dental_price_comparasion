<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Return all items.
     *
     * @return json
     */
    public function compareValues(Request $request)
    {
        $total = [];
        if (!empty($request->all())) {
            foreach ($request->all() as $product => $quantity) {
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
        }
        return response()->json([ucfirst($total['result']) . ' is cheaper - ' . $total[$total['result']]['total_pay'] . ' EUR']);
    }
}
