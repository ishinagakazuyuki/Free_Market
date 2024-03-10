<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ManageController;
use App\Http\Requests\ManageRequest;
use App\Models\User;
use App\Models\Profile;

class SendTest extends TestCase
{
    /**
     * Test for mypage
     *
     * @return void
     */
    public function testMyPage()
    {
        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/manage');
        $response->assertStatus(200);
        // 送信メールのダミーデータ
        $request = new ManageRequest([
            'address' => 'sam@example.com',
            'title' => 'Test Subject',
            'text' => 'Test Message',
        ]);
        // モックデータの作成
        $user = User::factory()->create(['email' => 'sam@example.com']);
        $profile = Profile::factory()->create(['user_id' => $user->id, 'name' => 'Sam Doe']);

        // コントローラーのインスタンス化
        $controller = new ManageController();

        // メール送信のテスト
        $response = $controller->send($request);

        // テストのアサーション
        $this->assertEquals('1', $response['menu_flg']); // menu_flgが1であることを確認
        $this->assertNotNull($response['users']); // usersがnullでないことを確認
    }
}
