<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Bonus;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        
        $bonuses = Bonus::all();
        
        foreach($bonuses as $bonusesdata){
   
            
           
        }
        
        $amount = 0;
        if(User::where('referral_code',$data['referral_code'])->exists()){
            $user_lists = User::where('referral_code',$data['referral_code'])->get();
            
        foreach($bonuses as $bonusesdata){
   
            $amount = $bonusesdata->ref_bonus;
           
      
            foreach($user_lists as $item){
                $info = User::where('id',$item->id)->first();
                User::where('id',$item->id)->update([
                   // 'amount' => $info->amount+10
                        'amount' => $info->amount+$amount
                ]);
            }
         }    
            
           // $amount = 10;
        }
        
       if($amount != NULL){
           
        foreach($bonuses as $bonusesdata){
   
            $new_amount = $bonusesdata->ref_bonus;
             $new_reg_amount = $bonusesdata->reg_bonus;
           
          $amnt = $new_amount + $new_reg_amount;
      

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'referral_code' => str::random(5) . time(),
            'phone' => $data['phone'],
            'amount' => $amnt,
            'password' => Hash::make($data['password']),
        ]);
        
        }
        
        //   $c_name = 'Test';
        //   Mail::to($data['email'])->send(new SendMailable($c_name));
       
            $datas = $data['email'];
        Mail::send('front-end.backend.email',$datas,function ($message) use ($datas){
            $message->to($datas);
            $message->subject('Welcome to GammimGen');
        });

        
       } else {
           
           
     foreach($bonuses as $bonusesdata){
   
            $reg_amount = $bonusesdata->reg_bonus;
           
              $regamnt = $reg_amount;
              
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'referral_code' => str::random(5) . time(),
            'phone' => $data['phone'],
            'amount' => $regamnt,
            'password' => Hash::make($data['password']),
        ]);
        
    }
           
           
       //   $c_name = 'Test';
       //   Mail::to($data['email'])->send(new SendMailable($c_name));
       
            $datas = $data['email'];
        Mail::send('front-end.backend.email',$datas,function ($message) use ($datas){
            $message->to($datas);
            $message->subject('Welcome to GammimGen');
        });
   
       }
    }
}
