<?php

namespace App\Http\Controllers;
use Carbon\Carbon;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VoucherController;
use App\Models\Voucher;
use App\Models\User;
class VoucherController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
        return view('/balance');
    }
    public function redeemVoucher($code)
    {

        if(!Auth::check()){
            $data = ['message' => 'Трябва да бъдете вписан, за да извършите тази заявка'];
            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  
              }
        $voucher = Voucher::where('code', $code)->first();
    
        if (!$voucher) {
            $data = ['message' => 'Не съществува такъв ваучер'];
            return response()->json($data, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  
        }
        
    
        if (Carbon::now()->gt($voucher->expiry_date) || !$voucher->voucher_valid) {
            $data = ['message' => 'Ваучера е изтекъл или е невалиден'];
            return response()->json($data, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  
        }
    
        $user = User::where('email', Auth::user()->email)->first();
        $user->balance += $voucher->value;
        $user->save();
        $voucher->voucher_valid = false;
        $voucher->save();

        $data = ['message' => 'Ваучера е приложен успешно, добавихте ' .  $voucher->value . ' лв'];
        return response()->json($data, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  

    }
    public function debugMode($code)
    {

        if(!Auth::check()){
            $data = ['message' => 'Трябва да бъдете вписан, за да извършите тази заявка'];
            return response()->json($voucher, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  

              }
        $voucher = Voucher::where('code', $code)->first();
    
        if (!$voucher) {
            $data = ['message' => 'Не съществува такъв ваучер'];

            return response()->json($data, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  

        }
        
    
        if (Carbon::now()->gt($voucher->expiry_date) || !$voucher->voucher_valid) {
            $data = ['message' => 'Ваучера е изтекъл или е невалиден'];
            return response()->json($voucher, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  
        }
    
        $user = User::where('email', Auth::user()->email)->first();
        $user->balance += $voucher->value;
        $user->save();
        $voucher->voucher_valid = false;
        $voucher->save();
        return response()->json($voucher, 400, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=UTF-8');  


    }
}    
