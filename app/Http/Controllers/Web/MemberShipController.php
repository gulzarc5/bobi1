<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use App\Mail\OrderMail;
use Mail;
use  SmsHelpers;

class MemberShipController extends Controller
{
    public function MembershipForm()
    {
        $member_ship_plan = false;
        $expiry_date = false;
        if (isset(Auth::guard('buyer')->user()->id) && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;
            $user = DB::table('users')->where('id',$user_id)->first();
            
            $expiry_date = $user->membership_expiry;
            if ($user->membership_status == '2') {
                $member = DB::table('membership_order')->where('user_id',$user_id)->where('payment_status',2)->orderBy('id','desc')->limit(1)->first();
                $member_ship_plan = $member->duration;
            }
        }
        
        return view('web.user.membership',compact('member_ship_plan','expiry_date'));
    }

    public function MembershipCheckout($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        return view('web.checkout.membership-checkout',compact('id'));
    }

    public function membershipOrderPlace($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user_id = Auth::guard('buyer')->user()->id;
        $name = null;
        $price = null;
        $duration = null;
        if($id == '1') {
            $name = 'Broonze';
            $price = 200;
            $duration = '3M';
        } elseif($id == '2'){
             $name = 'Silver';
            $price = 400;
            $duration = '6M';
        } else {
             $name = 'Gold';
            $price = 800;
            $duration = '1Y';
        }
        $membership_order = DB::table('membership_order')
            ->insertGetId([
                'user_id' => $user_id,
                'membership_name' => $name,
                'price' => $price,
                'duration' => $duration,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($membership_order) {

            $total_cost = $price;
            $user_name = Auth::guard('buyer')->user()->name;
            $user_email = Auth::guard('buyer')->user()->email;
            $user_mobile = Auth::guard('buyer')->user()->mobile;
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );     
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Membership Payment",
                    "amount" => $total_cost,
                    "buyer_name" => $user_name,
                    "send_email" => true,
                    "email" => $user_email,
                    "phone" => $user_mobile,
                    "redirect_url" => "http://127.0.0.1:8000/User/membership/Pay/Success/".encrypt($membership_order)
                    ));
    
                    DB::table('membership_order')
                        ->where('id',$membership_order)
                        ->update([
                            'payment_request_id' => $response['id'],
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                    
                    header('Location: ' . $response['longurl']);
                    exit();
            }catch (Exception $e) {
                print('Error: ' . $e->getMessage());
            }
        } else {
            return redirect()->back();
        }
        
    }

    public function MembershipPaySuccess(Request $request,$order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        try {
    
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
     
            $response = $api->paymentRequestStatus(request('payment_request_id'));
     
            if( !isset($response['payments'][0]['status']) ) {
             return redirect('web.user.membership');
            } else if($response['payments'][0]['status'] != 'Credit') {
             return redirect('web.user.membership');
            } 
          }catch (\Exception $e) {
             return redirect('web.user.membership');
         }
        
         if($response['payments'][0]['status'] == 'Credit') {
 
             $user_id = Auth::guard('buyer')->user()->id;
             DB::table('membership_order')
                     ->where('id', $order_id)
                     ->where('user_id', $user_id)
                     ->where('payment_request_id', $response['id'])
                     ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '2']);
            $user = DB::table('users')->where('id',$user_id)->first();
            $membership_order = DB::table('membership_order')->where('id',$order_id)->first();
            $duration_member = $membership_order->duration;
            if ($user->membership_status == '2') {
                
                $expiry_date = $user->membership_expiry;
                $new_expiry_date_time = Carbon::createFromDate($expiry_date , 'Asia/Kolkata');
                if ($duration_member == '3M') {
                    $new_expiry_date_time = $new_expiry_date_time->addMonths(3);
                }elseif($duration_member == '6M') {
                    $new_expiry_date_time = $new_expiry_date_time->addMonths(6);
                }else {
                    $new_expiry_date_time = $new_expiry_date_time->addYear(1);
                }
                $newExpDate = $new_expiry_date_time->format('Y-m-d');

                $user = DB::table('users')
                    ->where('id',$user_id)
                    ->update([
                        'membership_expiry' => $newExpDate,
                        'membership_status' => '2',
                    ]);

            }else{
                $new_expiry_date_time = Carbon::now('Asia/Kolkata');
                if ($duration_member == '3M') {
                    $new_expiry_date_time = $new_expiry_date_time->addMonths(3);
                }elseif($duration_member == '6M') {
                    $new_expiry_date_time = $new_expiry_date_time->addMonths(6);
                }else {
                    $new_expiry_date_time = $new_expiry_date_time->addYear(1);
                }
                $newExpDate = $new_expiry_date_time->format('Y-m-d');

                $user = DB::table('users')
                    ->where('id',$user_id)
                    ->update([
                        'membership_expiry' => $newExpDate,
                        'membership_status' => '2',
                    ]);

            }

            $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Membership has been successfully Activated , Enjoy Edujiyaan Membership. Thank You");
                $subject = "Edujiyaan Membership";
                $data = [
                    'message' => $request_info,
                    'subject' => $subject,
                ];
            Mail::to(Auth::guard('buyer')->user()->email)->send(new OrderMail($data));
            SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

            return redirect()->route('web.user.membership');
        } 
    }
}
