<?php
namespace App\Http\Handler;
use Carbon\Carbon;
use App\Coupon;

class CouponHandler {
    
    public function show($id,$listId,$campaignId)
    {
        $result = Coupon::where('client_id', '=', $id)
                            ->where('mail_chimp_list_id', $listId)
                            ->where('campaign_id', $campaignId)
                            ->firstOrFail();
        
        if($result->type == 'pet') {
            return $this->showPet($result);    
        } else {
            return $this->showNormal($result);
        }
         
    }
    
    protected function showPet(\App\Coupon $coupon)
    {
        $years = 0;
        if ($coupon->downloding_link_date != null) {
            
            $dt = Carbon::now();
            $past = Carbon::createFromFormat('Y-m-d', $coupon->downloding_link_date);
            $years = $dt->diffInYears($past);
            
            if($years >= 1) {
                $coupon->downloding_link_date = $dt->toDateString();
                $coupon->save();
                
                return $coupon;
            }
        } else if ($coupon->downloding_link_date == null) {
            $dt = Carbon::now();
            $coupon->downloding_link_date = $dt->toDateString();
            $coupon->save();
            return $coupon;
        }
        
        
        abort(404);
    }
    
    protected function showNormal(\App\Coupon $coupon)
    {
        if ($coupon->downloding_link_date == null) {
            $dt = Carbon::now();
            $coupon->downloding_link_date = $dt->toDateString();
            $coupon->save();
            return $coupon;
        }
        
        abort(404);
    }
}
