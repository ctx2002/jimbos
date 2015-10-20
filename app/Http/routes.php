<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/coupon/pet/{clientId}/{compaignId}/{dob}', array('uses' => 'CouponController@pet', 'as' => 'coupon.pet'));

Route::get('coupon/{clientId}/{campaignId}', array('uses' => 'CouponController@show', 'as' => 'coupon.show'));
Route::resource('coupon', 'CouponController',
                ['only' => ['store','index']]);
