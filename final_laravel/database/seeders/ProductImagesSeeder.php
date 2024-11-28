<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'urls' => json_encode([
                    'https://cdn.pnj.io/images/detailed/199/sp-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/199/sp-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/199/on-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-3.jpg',

                ]),
                'product_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'urls' => json_encode([
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-3.jpg',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-4.jpg',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-5.jpg',
                ]),
                'product_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'urls' => json_encode([
                    'https://cdn.pnj.io/images/detailed/69/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-01.png',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-02.png',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-03.jpg',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-04.jpg',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-05.jpg'
                ]),
                'product_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($images as $image) {
            ProductImage::create($image);
        }
    }
}