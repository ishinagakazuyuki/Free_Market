<?php
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;
use App\Models\mylist;
use App\Models\profile;

class IndexTest extends TestCase
{
    public function test_index_view_when_user_is_authenticated_with_existing_data()
    {
        $user = User::find(1);
        Auth::login($user);

        $items = Item::orderBy('id', 'desc')->get();
        $mylist = MyList::join('items', 'mylists.items_id', 'items.id')
            ->where('mylists.user_id', '=', $user->id)
            ->orderBy('mylists.id', 'desc')
            ->get();
        $profile = Profile::where('user_id', '=', $user->id)->first();

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewHas('menu_flg', "1");
        $response->assertViewHas('item', $items);
        $response->assertViewHas('mylist', $mylist);
    }
}
