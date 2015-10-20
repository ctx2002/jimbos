<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    
    public $timestamps = false;
    
    public static function loadCoupon(Request $request)
    {
        $coupon = new \App\Coupon();
        $data = $request->input('data');
        
        $coupon->client_id = $data['id'];
        $coupon->campaign_id = $data['merges']['campaign_uid'];
        $coupon->fname = $data['merges']['FNAME'];
        $coupon->lname = $data['merges']['LNAME'];
        $coupon->email = $data['merges']['EMAIL'];
        $coupon->pet_dob = isset($data['merges']['pet_dob'])? $data['merges']['pet_dob'] : null; 
        return $coupon;
    }
}
