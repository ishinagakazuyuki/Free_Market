<?php
use Illuminate\Foundation\Testing\TestCase;

class SellTest extends TestCase
{
    public function test_sell_page_loads_correctly()
    {
        $response = $this->get('/sell');
        $response->assertStatus(200);
        $response->assertViewHasAll(['menu_flg', 'brand', 'category', 'condition']);
    }
}