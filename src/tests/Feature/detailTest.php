<?php
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\item;
use App\Models\brand;
use App\Models\category;
use App\Models\condition;
use App\Models\mylist;
use App\Models\comment;

class DetailTest extends BaseTestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    public function test_detail()
    {
        $item = item::find(1);
        $itemId = $item['id'];
        $brandId = $item['brands_id'];
        $categoryId = $item['categories_id'];
        $conditionId = $item['conditions_id'];

        $response = $this->get('/detail/'.$itemId.'?id=' . $itemId);

        $response->assertStatus(200);

        $response->assertViewHasAll([
            'menu_flg',
            'item',
            'brand',
            'category',
            'condition',
            'favorite',
            'comment'
        ]);

        $item = Item::find($itemId);
        $response->assertViewHas('item', $item);

        $brand = Brand::find($brandId);
        $response->assertViewHas('brand', $brand);

        $category = Category::find($categoryId);
        $response->assertViewHas('category', $category);

        $condition = Condition::find($conditionId);
        $response->assertViewHas('condition', $condition);

        $favoriteCount = MyList::where('items_id', $itemId)->count();
        $response->assertViewHas('favorite', $favoriteCount);

        $commentCount = Comment::where('items_id', $itemId)->count();
        $response->assertViewHas('comment', $commentCount);
    }
}
