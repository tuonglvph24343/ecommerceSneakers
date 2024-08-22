<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WarehouseDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(WarehouseDataTable $dataTable)
    {
        return $dataTable->render('admin.product.warehouse.index');
    }
}
