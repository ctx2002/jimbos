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
        
        
        if($this->isLessThan6Month($result)) {
            if ($this->isFirst6Month($result)) {
                return $result;
            } else if (!$this->isUpdateWithin6Month($result)) {
                $tccHandler = new TccHandler(env('TCC_NUMBER_PET',''));
                $tcc = $tccHandler->handle($result);
                //$tcc = $tccHandler->getNewPetCoupon($result);
                $result->tcc_id = $tcc->RequestResult->Description;
                $result->added_on = Carbon::now()->toDateString();
                $result->save();  
            }
        }
        
        return $result;
    }
    
    protected function diffInMonth($dataStr, $format="Y-m-d")
    {
        $now = Carbon::now();
        $dob = Carbon::createFromFormat($format, $dataStr);
        return $now->diffInMonths($dob);
    }
    
    protected function isFirst6Month(\App\Coupon $coupon)
    {
        $month = $this->diffInMonth($coupon->pet_dob);
        if ($month  <= 6) {
            return true;
        }
        
        return false;
    }
    
    
    
    protected function isLessThan6Month(\App\Coupon $coupon)
    {
        $month = $this->diffInMonth($coupon->pet_dob);       
        if ($month  < 0) return false;
        
        //pet birth day is 6 months to current date
        if ($month % 12 >=0 && $month % 12 <= 6) {
            return true;
        }
        
        return false;
    }
    
    private function isUpdateWithin6Month(\App\Coupon $coupon)
    {
        $updateMonth = $this->diffInMonth($coupon->added_on,'Y-m-d H:i:s');
        if ($updateMonth <= 6) {
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
