<?php

namespace App\Http\Controllers\Admin;

use Ganguo\ClientAggregationUpload\Factory;

class SupplierController extends Controller
{
    public function getUpload()
    {
        $drive = request('drive', 'qiniu');

        $data = (new Factory($drive))->getParameter();

        return \Response::success($data);
    }

    public function postUpload(\Illuminate\Http\Request $request)
    {
        $data = (new Factory())->local($request);

        return \Response::success($data);
    }
}
