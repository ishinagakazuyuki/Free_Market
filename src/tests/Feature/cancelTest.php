<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\buyer;

class CancelTest extends TestCase
{
    /**
     * Test for mypage
     *
     * @return void
     */
    public function testMyPage()
    {
        $user = User::first();
        $buyer = buyer::where('user_id','=',$user['id'])->first();
        $buyerId = $buyer['id'];
        $this->actingAs($user);
        $response = $this->get('/cancel/'.$buyerId.'?id=' . $buyerId);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg']);
    }
}
