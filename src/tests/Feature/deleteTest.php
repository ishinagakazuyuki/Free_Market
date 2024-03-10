<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DeleteTest extends TestCase
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
        $dummy = User::factory()->create([
            'email' => 'john@example.com',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
        $requestData = [
            'id' => $dummy['id'],
        ];
        $response = $this->post('/manage/delete', $requestData);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg','users']);
    }
}
