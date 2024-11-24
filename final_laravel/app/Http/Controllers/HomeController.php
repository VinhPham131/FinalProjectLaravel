<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class HomeController extends Controller
{
    public function index()
    {
        $slideshowImages = [
            'https://asset.swarovski.com/c_crop,g_xy_center,w_11455,h_3877,x_5728,y_3892/f_auto,q_auto,dpr_2.0/swa-cms/LOOKBOOKSS24_LOOK06-1_OF_GL_72DPI_RGB_SALE.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_11348,h_3842,x_5669,y_4529/dpr_2.0,f_auto,q_auto,c_lfill,w_1449,h_830/swa-cms/LOOKBOOKSS24_LOOK06-2_OF_GL_72DPI_RGB_EXT2/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_6649,h_2251,x_3325,y_1126/dpr_2.0,f_auto,q_auto,c_lfill,w_1449,h_830/swa-cms/2024_MOL-MILAN_ARCHSHOT_VISUAL_FUTURE-HISTORY-2_GL_72DPI_RGB/.jpg',
            'https://media.tiffany.com/is/image/tiffanydm/2024-TITAN-HP-Stories-1?$tile$&wid=736&hei=920&fmt=webp',
            'https://cms-live-rc.pandora.net/resource/responsive-image/2994966/m66-feature-module/lg/5/q124-editorial-aprilmay-mostloved-model-summercelebration-twoimageoverlap.jpg',
        ];

        // Fetch products from the database
        $products = Product::with('images')->get();

        return view('home', compact('slideshowImages', 'products'));
    }
}
