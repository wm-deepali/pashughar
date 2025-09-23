<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletOnlinePayment;
use Carbon\Carbon;
class WalletOnlinePaymentController extends Controller
{
    //
    public function index()
    {

        $wallet=WalletOnlinePayment::first();
        
        return view('wallet-online-payment-master')->with([
            'wallet'=>$wallet,
        ]);
    }
    public function store(Request $request){
        $var = Carbon::now('Asia/Kolkata');
        if($request->hasFile('image')){
            $path1=$request->image->store('barcode', 'public');
        }
        else{
            $path1=$request->image;
        }
        
      // dd($request);
        WalletOnlinePayment::where('id',1)->update([

            'bar_code_image'=>$path1,
            'account_number'=>$request->account_number,
            'bank_account_name'=>$request->bank_account_name,
            'ifsc_code'=>$request->ifsc_code,
            'upi_id'=>$request->upi_id,
            'bank_branch'=>$request->bank_branch,
            'bank_name'=>$request->bank_name,
            'swift_code'=>$request->swift_code,

        ]);
       // dd($request);
        return back()->with('success','Detail Store Successfully');
       
    }
}
