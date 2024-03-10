<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;
use App\Models\brand;
use App\Models\category;
use App\Models\condition;
use App\Models\mylist;
use App\Models\comment;
use App\Models\profile;
use App\Models\permission;

class CommentTest extends TestCase
{
    /**
     * 既存データを使用してコメントページをテストする
     *
     * @return void
     */
    public function test_comment_page_with_existing_data()
    {
        // 既存のデータを用意する
        $item = Item::find(1);
        $brand = Brand::find($item->brands_id);
        $category = Category::find($item->categories_id);
        $condition = Condition::find($item->conditions_id);
        $favoriteCount = Mylist::where('items_id', $item->id)->count();
        $commentCount = Comment::where('items_id', $item->id)->count();
        $user = Profile::join('comments', 'profiles.user_id', 'comments.user_id')
            ->where('items_id', $item->id)->get();
        $own = user::first();
        $this->actingAs($own);
        $permission = Permission::where('user_id', $own->id)->first();

        $response = $this->get('/comment?id=' . $item->id);
        // レスポンスが正常であることをアサートする
        $response->assertStatus(200);

        // ビューに必要なデータが含まれていることをアサートする
        $response->assertViewHas('menu_flg', '1');
        $response->assertViewHas('own', $own);
        $response->assertViewHas('item', $item);
        $response->assertViewHas('brand', $brand);
        $response->assertViewHas('category', $category);
        $response->assertViewHas('condition', $condition);
        $response->assertViewHas('favorite', $favoriteCount);
        $response->assertViewHas('comment', $commentCount);
        $response->assertViewHas('user', $user);
        $response->assertViewHas('permission', $permission);
    }
}