<?php

namespace Tests\Unit\Back;


use App\Http\Requests\Back\CreateUserRequest;
use Illuminate\Support\Facades\Validator;

use Tests\TestCase;

class CreateUserRequestTest extends TestCase
{
    /**
     * @param array カラム名の配列
     * @param array 入力値の配列
     * @param array 期待値(true: 入力値に問題無し, false: 入力値に問題あり)
     *
     * @dataProvider inputs
     */
    public function testRegistrationRequest(array $keys, array $values, bool $expected)
    {
        $data = array_combine($keys, $values);

        $request = new CreateUserRequest();

        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function inputs()
    {
        return [
            '正常系' => [
                ['name', 'email', 'address', 'phone_number', 'password', 'password_confirmation'],
                ['test', 'test@example.com', 'test', '08012341234', 'password', 'password'],
                true,
            ],
        ];
    }
}
