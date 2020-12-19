<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Front\User;
use App\Models\Back\Operator;
use App\Models\Back\Maker;
use App\Models\Back\Category;
use App\Models\Back\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tarou',
            'email' => 'tarou@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'address' => '東京都八王子市 hogehoge',
            'phone_number' => '08012341234',
        ]);
        User::factory(10)->create();

        Operator::create([
            'name' => 'fukuta',
            'email' => 'fukuta@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Operator::factory(10)->create();

        DB::table('makers')->insert([
            [
                'name' => '株式会社A',
                'email' => 'a@example.com',
                'phone_number' => '0312341234',
                'address' => '東京都八王子市hoge',
            ],
            [
                'name' => '株式会社B',
                'email' => 'b@example.com',
                'phone_number' => '0312341234',
                'address' => '北海道札幌市',
            ],
            [
                'name' => '株式会社C',
                'email' => 'c@example.com',
                'phone_number' => '0312341234',
                'address' => '沖縄県那覇市',
            ],
            [
                'name' => '株式会社D',
                'email' => 'd@example.com',
                'phone_number' => '0312341234',
                'address' => '神奈川県横浜氏',
            ],
        ]);

        DB::table('categories')->insert([
            ['name' => '家電・カメラ・AV機器'],
            ['name' => 'PC・オフィス用品'],
            ['name' => 'ファッション'],
            ['name' => '本'],
            ['name' => '日用品'],
            ['name' => 'スポーツ・アウトドア'],
        ]);

        DB::table('products')->insert([
            [
                'jan_code' => '1111234567890',
                'category_id' => 1,
                'maker_id' => 1,
                'name' => '洗濯機',
                'price' => 20000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => '容量たっぷり10kgの、全自動洗濯機です。
                豊富なコースでいつものお洗濯はもちろん、おしゃれ着や毛布もご自宅で手軽にお洗濯できます。
                洗濯槽は、丈夫で汚れに強いステンレス製。',
                'is_published' => true,
            ],
            [
                'jan_code' => '111234568901',
                'category_id' => 1,
                'maker_id' => 2,
                'name' => '冷蔵庫',
                'price' => 32000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => '空間に調和する、上質なデザイン。
                買い置き・作り置きに便利な大きめ冷凍室。
                食品が見やすいLED照明とお手入れ簡単ガラストレイ。',
                'is_published' => true,
            ],
            [
                'jan_code' => '111345678901',
                'category_id' => 1,
                'maker_id' => 4,
                'name' => 'サーキュレーター',
                'price' => 4000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => '扇風機よりもパワフル送風のサーキュレーターです。静音モード搭載で35dB以下の静かなサーキュレーターです。直線的なパワフル送風で室内の空気を循環させ、夏は冷房、冬は暖房効率を上げ一年中使えます。温度設定を抑えられるので消費電力が少なく省エネにつながります。',
                'is_published' => true,
            ],
            [
                'jan_code' => '112123456789',
                'category_id' => 2,
                'maker_id' => 1,
                'name' => 'ノートパソン',
                'price' => 90000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => 'Windows10 Pro 64bit Core i5-8250U 1.6GHz CPU 、メモリ8GB(8Gx1 空スロットx1 最大32GB DDR4 PC4-19200) 、HDD 500GB(7200rpm)、15.6型HD・TN液晶ノートパソコン(最大解像度1366x768)',
                'is_published' => true,
            ],
            [
                'jan_code' => '112234567890',
                'category_id' => 2,
                'maker_id' => 2,
                'name' => 'ディスプレイ',
                'price' => 13000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => '画面サイズ:23型ワイド/解像度:1920×1080 フルHD/パネル:IPS/表面仕様:ノングレア/バックライト:LED。入力端子:HDMI, D-Sub 15ピン/入力端子:3.5mmステレオミニジャック。 ',
                'is_published' => true,
            ],
            [
                'jan_code' => '1131234567890',
                'category_id' => 3,
                'maker_id' => 3,
                'name' => 'Tシャツ',
                'price' => 3000,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => 'ヘビーウェイト(肉厚)生地のため丈夫で長持ち、洗いこんでも首回りが伸びにくく型崩れしない強さ、耐久性があります。 コットン100%の生地を使用し、着心地の良さは抜群。洗えば洗うほど肌に馴染む風合いは、BEEFY-Tならではの快適性を発揮します。 縫い目の無い丸胴ボディを採用。アメリカを感じるクラシックなシルエットです。男性のみならず、女性のお客様にもおすすめ。
                ',
                'is_published' => true,
            ],
            [
                'jan_code' => '1132345678901',
                'category_id' => 3,
                'maker_id' => 4,
                'name' => 'ジーンズ',
                'price' => 4500,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Square_200x200.svg/200px-Square_200x200.svg.png',
                'description' => '希少なセルビッジデニムを使用。はき込むほどに味のある色落ちが楽しめる。',
                'is_published' => true,
            ],
        ]);
    }
}
