<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;

class PurchaseTest extends TestCase
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
        $response = $this->get('/purchase/{item_id}'.$itemId.'?id=' . $itemId);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg','item','profile','payment']);
    }
}