<?php
namespace App\Http\Handler;
use Carbon\Carbon;
use App\Coupon;
use App\Http\Handler\TccHandler;

class CouponHandler {
    
    public function show($id,$campaignId)
    {
        $result = Coupon::where('client_id', '=', $id)
                            //->where('mail_chimp_list_id', $listId)
                            ->where('campaign_id', $campaignId)
                            ->firstOrFail();
        
        
        return  $result;
         
    }
    
    public function pet($clientId, $campaignId, $dob)
    {
        //if pet not exits , 404
        $result = Coupon::where('client_id', '=', $clientId)
                            ->where('campaign_id', '=', $campaignId)
                            ->where('pet_dob', '=' , $dob)
                            ->firstOrFail();
        
        //if is first 6 month? which means , just send back tcc information
        if ($this->diffInMonth($result) < 0) {
            return null;
        } else if ($this->isFirst6Month($result)) {
            return $result;
        } else {
            //not first 6 month, but less than 6 month to dob
            if ($this->isLessThan6Month($result)) {
                //fetching a new pdf
                $tccHandler = new TccHandler();
                $tcc = $tccHandler->handle($result);
                //$tcc = $tccHandler->getNewPetCoupon($result);
                $result->tcc_id = $tcc->RequestResult->Description;
                $result->save();
                return $result;
            }
        }
        
        return null;
    }
    
    protected function diffInMonth(\App\Coupon $coupon)
    {
        $now = Carbon::now();
        $dob = Carbon::createFromFormat('Y-m-d', $coupon->pet_dob);
        return $now->diffInMonths($dob);
    }
    
    protected function isFirst6Month(\App\Coupon $coupon)
    {
        $month = $this->diffInMonth($coupon);
        if ($month  <= 6) {
            return true;
        }
        
        return false;
    }
    
    
    
    protected function isLessThan6Month(\App\Coupon $coupon)
    {
        $month = $this->diffInMonth($coupon);       
        if ($month  < 0) return false;
        
        if ($month % 12 >=0 && $month % 12 <= 6) {
            return true;
        }
        return false;
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
