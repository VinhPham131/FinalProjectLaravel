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
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/199/sp-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/199/sp-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/199/on-gvpaxmw000044-vong-tay-vang-trang-14k-dinh-ngoc-trai-akoya-pnj-3.jpg',
                ],
                'product_id' => 1,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-3.jpg',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-4.jpg',
                    'https://cdn.pnj.io/images/detailed/140/gvxmxmw000167-vong-tay-vang-trang-y-18k-dinh-da-cz-pnj-5.jpg',
                ],
                'product_id' => 2,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/69/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-01.png',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-02.png',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-03.jpg',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-04.jpg',
                    'https://cdn.pnj.io/images/detailed/132/gvrbxmy000180-vong-tay-vang-18k-dinh-da-ruby-pnj-sac-xuan-05.jpg',
                ],
                'product_id' => 3,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/192/sp-snxm00w000076-nhan-bac-dinh-da-style-by-pnj-feminine-1.png',
                    'https://cdn.pnj.io/images/detailed/192/sp-snxm00w000076-nhan-bac-dinh-da-style-by-pnj-feminine-2.png',
                    'https://cdn.pnj.io/images/detailed/192/sp-snxm00w000076-nhan-bac-dinh-da-style-by-pnj-feminine-3.png',
                    'https://cdn.pnj.io/images/detailed/192/on-snxm00w000076-nhan-bac-dinh-da-style-by-pnj-feminine-1.jpg',
                    'https://cdn.pnj.io/images/detailed/192/on-snxm00w000076-nhan-bac-dinh-da-style-by-pnj-feminine-2.jpg',
                ],
                'product_id' => 4,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/210/sp-sbxm00k000141-bong-tai-bac-dinh-da-pnjsilver-1.png',
                    'https://cdn.pnj.io/images/detailed/210/sp-sbxm00k000141-bong-tai-bac-dinh-da-pnjsilver-2.png',
                    'https://cdn.pnj.io/images/detailed/210/on-sbxm00k000141-bong-tai-bac-dinh-da-pnjsilver-1.jpg',
                    'https://cdn.pnj.io/images/detailed/210/on-sbxm00k000141-bong-tai-bac-dinh-da-pnjsilver-2.jpg',
                    'https://cdn.pnj.io/images/detailed/210/on-sbxm00k000141-bong-tai-bac-dinh-da-pnjsilver-3.jpg',
                ],
                'product_id' => 5,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/209/sp-slxm00k000021-lac-chan-bac-dinh-da-pnjsilver-hinh-trai-tim-1.png',
                    'https://cdn.pnj.io/images/detailed/209/sp-slxm00k000021-lac-chan-bac-dinh-da-pnjsilver-hinh-trai-tim-2.png',
                    'https://cdn.pnj.io/images/detailed/209/sp-slxm00k000021-lac-chan-bac-dinh-da-pnjsilver-hinh-trai-tim-3.png',
                ],
                'product_id' => 6,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/209/sp-scxm00k000041-day-co-bac-dinh-da-pnjsilver-mat-vong-tron-1.png',
                    'https://cdn.pnj.io/images/detailed/209/sp-scxm00k000041-day-co-bac-dinh-da-pnjsilver-mat-vong-tron-2.png',
                    'https://cdn.pnj.io/images/detailed/209/sp-scxm00k000041-day-co-bac-dinh-da-pnjsilver-mat-vong-tron-3.png',
                    'https://cdn.pnj.io/images/detailed/209/on-scxm00k000041-day-co-bac-dinh-da-pnjsilver-mat-vong-tron-1.jpg',
                    'https://cdn.pnj.io/images/detailed/209/on-scxm00k000041-day-co-bac-dinh-da-pnjsilver-mat-vong-tron-2.jpg',
                ],
                'product_id' => 7,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/170/sp-gbpaxmw000042-bong-tai-vang-trang-14k-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/170/sp-gbpaxmw000042-bong-tai-vang-trang-14k-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/170/sp-gbpaxmw000042-bong-tai-vang-trang-14k-pnj-3.png',
                    'https://cdn.pnj.io/images/detailed/170/on-gbpaxmw000042-bong-tai-vang-trang-14k-pnj-1.jpg',
                    'https://cdn.pnj.io/images/detailed/170/on-gbpaxmw000042-bong-tai-vang-trang-14k-pnj-2.jpg',
                ],
                'product_id' => 8,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/219/sp-snxm00c000034-nhan-bac-dinh-da-style-by-pnj-dna-1.png',
                    'https://cdn.pnj.io/images/detailed/219/sp-snxm00c000034-nhan-bac-dinh-da-style-by-pnj-dna-2.png',
                    'https://cdn.pnj.io/images/detailed/219/sp-snxm00c000034-nhan-bac-dinh-da-style-by-pnj-dna-3.png',
                    'https://cdn.pnj.io/images/detailed/219/on-snxm00c000034-nhan-bac-dinh-da-style-by-pnj-dna-2.jpg',
                    'https://cdn.pnj.io/images/detailed/219/on-snxm00c000034-nhan-bac-dinh-da-style-by-pnj-dna-3.jpg',
                ],
                'product_id' => 9,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/230/sp-snxm00y060007-nhan-bac-dinh-da-pnjsilver-1.png',
                    'https://cdn.pnj.io/images/detailed/230/sp-snxm00y060007-nhan-bac-dinh-da-pnjsilver-2.png',
                    'https://cdn.pnj.io/images/detailed/230/sp-snxm00y060007-nhan-bac-dinh-da-pnjsilver-3.png',
                    'https://cdn.pnj.io/images/detailed/230/on-snxm00y060007-nhan-bac-dinh-da-pnjsilver-1.jpg',
                    'https://cdn.pnj.io/images/detailed/230/on-snxm00y060007-nhan-bac-dinh-da-pnjsilver-2.jpg',
                ],
                'product_id' => 10,
            ],
            [
                'paths' => [
                    'https://cdn.pnj.io/images/detailed/226/sp-gmddddw060415-mat-day-chuyen-kim-cuong-vang-trang-14k-pnj-1.png',
                    'https://cdn.pnj.io/images/detailed/226/sp-gmddddw060415-mat-day-chuyen-kim-cuong-vang-trang-14k-pnj-2.png',
                    'https://cdn.pnj.io/images/detailed/226/sp-gmddddw060415-mat-day-chuyen-kim-cuong-vang-trang-14k-pnj-3.png',
                ],
                'product_id' => 11,
            ],
        ];

        foreach ($images as $image) {
            foreach ($image['paths'] as $path) {
                ProductImage::create([
                    'product_id' => $image['product_id'],
                    'image_path' => $path,
                ]);
            }
        }
    }
}
