<?php

namespace tests\Unit\Back;


use App\Http\Requests\Back\CreateMakerRequest;
use Illuminate\Support\Facades\Validator;

use Tests\TestCase;

class UpdateMakerRequestTest extends TestCase
{
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

        $request = new CreateMakerRequest();

        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function inputs()
    {
        return [
            '正常系' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', 'test', '08012341234'],
                true,
            ],

            '会社名未入力' => [
                ['name', 'email', 'address', 'phone_number'],
                ['', 'test@example.com', 'test', '08012341234'],
                false,
            ],
            '会社名最大文字数超過' => [
                ['name', 'email', 'address', 'phone_number'],
                [str_repeat('a', 51), 'test@example.com', 'test', '08012341234'],
                false,
            ],

            'メールアドレス未入力' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', '', 'test', '08012341234'],
                false,
            ],
            '不正なメールアドレス形式' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test', 'test', '08012341234'],
                false,
            ],
            'メールアドレス文字数超過' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', str_repeat('a', 255) . '@example.com', 'test', '08012341234'],
                false,
            ],

            '住所未入力' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', '', '08012341234'],
                false,
            ],
            '住所文字数超過' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', str_repeat('a', 201), '08012341234'],
                false,
            ],

            '電話番号未入力' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', 'test', ''],
                false,
            ],
            '電話番号文字列' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', 'test', 'test'],
                false,
            ],
            '電話番号桁不足' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', 'test', str_repeat(1, 7)],
                false,
            ],
            '電話番号桁超過' => [
                ['name', 'email', 'address', 'phone_number'],
                ['test', 'test@example.com', 'test', str_repeat(1, 12)],
                false,
            ],
        ];
    }
}
