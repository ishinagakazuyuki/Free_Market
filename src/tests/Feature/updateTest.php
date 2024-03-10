<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;

class UpdateTest extends TestCase
{
    /**
     * Test for mypage
     *
     * @return void
     */
    public function testMyPage()
    {
        //テストを実行する前にMypageController.phpの47,75,103行目の「local」を「testing」に変更してください。
        $this->markTestIncomplete('このテストを実行する際はこの行をコメントアウトしてください');
        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/mypage/profile');
        $response->assertStatus(200);
        $uploadedFile = new UploadedFile(storage_path('app/public/images/1_20240120232753.jpg'), '1_20240120232753.jpg', 'image/jpeg', null, true);
        $requestData = [
            'name' => 'Test Name',
            'post_code' => 1111111,
            'address' => 'テスト',
            'building' => 'テスト',
            'image' => $uploadedFile,
        ];
        $response = $this->post('/mypage/profile', $requestData);
        $response->assertStatus(200);

        $this->assertDatabaseHas('profiles', [
            'name' => 'Test Name',
        ]);
    }
}
