<?php

namespace tests\Unit\Back;

use App\Http\Requests\Back\CreateCategoryRequest;
use Illuminate\Support\Facades\Validator;

use Tests\TestCase;

class CreateCategoryRequestTest extends TestCase
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
        $request = new CreateCategoryRequest();

        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function inputs()
    {
        return [
            '正常系' => [
                ['name'], ['test'], true,
            ],

            'カテゴリー名未入力' => [
                ['name'], [''], false,
            ],
            'カテゴリー名文字数超過' => [
                ['name'], [str_repeat('a', 31)], false,
            ],
        ];
    }
}
