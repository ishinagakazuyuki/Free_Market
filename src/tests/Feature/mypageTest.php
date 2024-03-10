<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class MyPageTest extends TestCase
{
    /**
     * Test for mypage
     *
     * @return void
     */
    public function testMyPage()
    {
        //テストを実行する前にMypageController.phpの22行目の「local」を「testing」に変更してください。
        $this->markTestIncomplete('このテストを実行する際はこの行をコメントアウトしてください');
        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/mypage');
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg', 'profile', 'url', 'item', 'buy']);
    }
}
