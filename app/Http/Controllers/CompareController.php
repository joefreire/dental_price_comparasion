<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComparePostRequest;
use App\Http\Responses\CompareResponse;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Return all items.
     *
     * @return App\Http\Responses\CompareResponse;
     */
    public function compareValues(Request $request)
    {
        $compareRequest = new ComparePostRequest($request->all());
        if (!$compareRequest->validate()) {
            $result = new CompareResponse([], 403);
            return $result->response();
        }
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
        $result = new CompareResponse($total, 200);
        return $result->response();
    }
}
