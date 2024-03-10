<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSold()
    {
        // テストユーザーを作成
        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/sell');
        $response->assertStatus(200);
        $requestData = [
            'id' => 1,
            'name' => 'Test Item',
            'payment' => 'コンビニ支払い',
            'value' => 1000,
        ];
        $response = $this->get(route('sold', $requestData));
        $response->assertStatus(200);
        $response->assertViewHas(['menu_flg', 'user_id', 'items_id', 'name', 'payment', 'datetime', 'value', 'method']);
    }
}
