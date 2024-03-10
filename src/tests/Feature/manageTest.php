<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ManageTest extends TestCase
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
        $response->assertViewHasAll(['menu_flg','users']);
    }
}
