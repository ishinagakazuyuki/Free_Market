<?php

use Illuminate\Foundation\Testing\TestCase;
use App\Models\User;
use App\Models\Item;

class CommentFavoriteTest extends TestCase
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

    public function testCommentFavorite()
    {
        $user = User::first();
        $item = Item::first();
        $this->actingAs($user);
        $response = $this->get('/comment?id=' . $item->id);
        $response->assertStatus(200);
        $requestData = ['id' => $item->id];
        $response = $this->post('/comment/favorite', $requestData);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg', 'own', 'item', 'brand', 'category', 'condition', 'favorite', 'comment', 'user', 'permission']);
    }
}
