<?php

namespace Modules\CompanyOrDesign\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CompanyOrDesign\Services\TxtOrderService;

class ExportController extends Controller
{

    public function txtOrders(Request $request)
    {
        $txt =  new TxtOrderService();
        $txt->run();
        return $txt->download();
    }

}