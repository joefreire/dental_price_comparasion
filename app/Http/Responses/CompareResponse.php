<?php

namespace App\Http\Responses;

class CompareResponse
{
    public $data;
    public $code;
    public function __construct($data, $code)
    {
        $this->data = $data;
        $this->code = $code;
    }
    public function response()
    {
        $total = $this->data;
        if ($this->code == 200 && isset($total['result'])) {
            return response()->json(ucfirst($total['result']) . ' is cheaper - ' . $total[$total['result']]['total_pay'] . ' EUR');
        } elseif ($this->code == 403) {
            return response()->json('Error on request');
        }
        return response()->json('Error');
    }
}
