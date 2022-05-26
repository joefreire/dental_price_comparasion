<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComparePostRequest;
use App\Http\Responses\CompareResponse;
use App\Repositories\CompareRepository;
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
        $compareRepo = new CompareRepository($request->all());
        $total = $compareRepo->compare();
        $result = new CompareResponse($total, 200);
        return $result->response();
    }
}
