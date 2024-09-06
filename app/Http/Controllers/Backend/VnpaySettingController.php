<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VnpaySetting;
use Illuminate\Http\Request;

class VnpaySettingController extends Controller
{
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'integer'],
            'country_name' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'vnpay_key' => ['required'],
            'vnpay_secret_key' => ['required']
        ]);

        VnpaySetting::updateOrCreate(
            ['id' => $id],
            [
                'status' => $request->status,
                'country_name' => $request->country_name,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'vnpay_key' => $request->vnpay_key,
                'vnpay_secret_key' => $request->vnpay_secret_key,
            ]
        );

        toastr('Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
