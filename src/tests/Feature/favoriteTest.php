<?php
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;
use App\Models\brand;
use App\Models\category;
use App\Models\condition;
use App\Models\mylist;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class FavoriteTest extends TestCase
{
    public function test_favorite_process()
    {
        $user = User::find(1);
        $item = Item::find(1);
        $this->actingAs($user);
        $favorite = mylist::where('user_id','=',$user['id'])->where('items_id','=',$item['id'])->first();

        $requestData = ['id' => $item->id];
        $response = $this->post('/favorite', $requestData);
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg', 'item', 'brand', 'category', 'condition', 'favorite', 'comment']);

        if (empty($favorite)){
            $favoriteExists = Mylist::where('user_id', $user->id)->where('items_id', $item->id)->exists();
            if ($favoriteExists) {
                $this->assertTrue(true);
            } else {
                $this->assertTrue(false);
            }
        } else {
            $favoriteStillExists = Mylist::where('user_id', $user->id)->where('items_id', $item->id)->exists();
            if ($favoriteStillExists) {
                $this->assertTrue(false);
            } else {
                $this->assertTrue(true);
            }
        }
    }
}
