<?php
use Tests\TestCase;
use App\Models\User;
use App\Models\item;

class PostTest extends TestCase
{
    public function test_comment_post_with_existing_data()
    {
        $user = User::first();
        $item = Item::first();
        $commentData = [
            'id' => $item->id,
            'comment' => 'Test comment',
        ];

        $response = $this->actingAs($user)->post('/comment', $commentData);

        $response->assertStatus(200); // または適切なリダイレクト先の確認

        // ビューのアサートなど他のアサーションも追加することができます
    }
}