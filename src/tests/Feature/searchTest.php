<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\item;
use App\Models\brand;
use App\Models\category;

class SearchTest extends TestCase
{
    public function test_search_with_existing_data()
    {
        $user = User::find(1);
        $searchKeyword = "時計";

        $response = $this->actingAs($user)->post('/search', ['search' => $searchKeyword]);
        $response->assertStatus(200);

        $responseData = $response->original;

        if (empty($searchKeyword)) {
            $this->assertEquals("全件検索を行いました", $responseData['message']);
        } else {
            if ($responseData['item'] === null) {
                $this->assertEquals($searchKeyword."の検索結果はありません", $responseData['message']);
            } else {
                $this->assertEquals($searchKeyword."を検索した結果、".$responseData['item']->count()."件がヒットしました", $responseData['message']);
            }
        }

        $this->assertArrayHasKey('menu_flg', $responseData);
        $this->assertArrayHasKey('item', $responseData);
        $this->assertArrayHasKey('message', $responseData);
    }
}