<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;

class Address_updateTest extends TestCase
{
    /**
     * Test for mypage
     *
     * @return void
     */
    public function testMyPage()
    {
        $user = User::first();
        $item = item::first();
        $itemId = $item['id'];
        $this->actingAs($user);
        $response = $this->get('/purchase/address/{item_id}'.$itemId.'?id=' . $itemId);
        $response->assertStatus(200);
        $requestData = [
            'payment' => 'クレジットカード払い',
        ];
        $response = $this->post('/purchase/address/{item_id}'.$itemId.'?id=' . $itemId,$requestData);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg','item','profile']);
    }
}
