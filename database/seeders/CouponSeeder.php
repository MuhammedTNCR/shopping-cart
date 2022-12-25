<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
            [
                'code' => '123456',
                'value' => 10
            ],
            [
                'code' => 'abcdef',
                'value' => 20
            ]
        ];

        foreach ($coupons as $coupon) {
            Coupon::create([
                'code' => $coupon['code'],
                'value' => $coupon['value']
            ]);
        }
    }
}
