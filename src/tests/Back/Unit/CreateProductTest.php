<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

use App\Http\Requests\Back\CreateProductRequest;
use App\Models\Back\Category;
use App\Models\Back\Maker;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param array カラム名の配列
     * @param array 入力値の配列
     * @param array 期待値(true: 入力値に問題無し, false: 入力値に問題あり)
     *
     * @dataProvider inputs
     */
    public function testRequest(array $keys, array $values, bool $expected)
    {
        $data = array_combine($keys, $values);

        $request = new CreateProductRequest();

        Category::factory(1)->create()->first();
        Maker::factory(1)->create()->first();

        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function inputs()
    {
        return [
            '正常系' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                true,
            ],

            'カテゴリー未選択' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [null, 1, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],
            '存在しないカテゴリーを選択' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [0, 1, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],
            'カテゴリーに文字数を入力' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                ['test', 1, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],

            'メーカー未選択' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, null, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],
            '存在しないメーカーを選択' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 0, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],
            'メーカー - 文字列' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 'test', 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],

            '商品名未入力' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, null, 2000, "http://example.com", 'テスト', true],
                false,
            ],
            '商品名文字数超過' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, str_repeat('a', 101), 2000, "http://example.com", 'テスト', true],
                false,
            ],

            '販売価格未入力' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', null, "http://example.com", 'テスト', true],
                false,
            ],
            '販売価格 - 文字列' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 'test', "http://example.com", 'テスト', true],
                false,
            ],
            '販売価格 - 負の数' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", 'テスト', true],
                false,
            ],
            '販売価格 - 最大値超過' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 1000000, "http://example.com", 'テスト', true],
                false,
            ],

            '画像URL - 不正な文字列' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "test", 'テスト', true],
                false,
            ],

            '商品説明 - 文字数超過' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", str_repeat('a', 256), true],
                false,
            ],

            '公開区分 - 未入力' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", 'テスト', null],
                false,
            ],
            '公開区分 - 文字列' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", 'テスト', 'test'],
                false,
            ],
            '公開区分 - 数値' => [
                ['category_id', 'maker_id', 'name', 'price', 'image_url', 'description', 'is_published'],
                [1, 1, 'テスト商品', 2000, "http://example.com", 'テスト', 0],
                false,
            ],
        ];
    }
}
