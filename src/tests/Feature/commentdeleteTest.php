<?php

use Illuminate\Foundation\Testing\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Item;

class CommentDeleteTest extends TestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    public function testCommentDelete()
    {
        $user = User::first();
        $item = Item::first();
        $comment = Comment::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->post('/comment/delete', ['id' => $item->id, 'comment_id' => $comment->id]);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg', 'own', 'item', 'brand', 'category', 'condition', 'favorite', 'comment', 'user', 'permission']);
    }
}