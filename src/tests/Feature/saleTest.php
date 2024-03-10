<?php
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class SaleTest extends BaseTestCase
{
    // createApplicationメソッドを実装
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }
    public function test_sale_process()
    {
        //テストを実行する前にItemController.phpの105行目の「local」を「testing」に変更してください。
        $this->markTestIncomplete('このテストを実行する際はこの行をコメントアウトしてください');
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/sell');
        $response->assertStatus(200);

        $response->assertViewHasAll(['menu_flg', 'brand', 'category', 'condition']);

        $uploadedFile = new UploadedFile(storage_path('app/public/images/1_20240120232753.jpg'), '1_20240120232753.jpg', 'image/jpeg', null, true);
        $requestData = [
            'user_id' => 1,
            'name' => 'Test Item',
            'brand' => 1,
            'description' => 'テスト',
            'category' => 1,
            'condition' => 1,
            'value' => 1000,
            'image' => $uploadedFile,
        ];

        $response = $this->post('/sell', $requestData);
        $response->assertStatus(200);

        $this->assertDatabaseHas('items', [
            'name' => 'Test Item',
        ]);
    }
}
