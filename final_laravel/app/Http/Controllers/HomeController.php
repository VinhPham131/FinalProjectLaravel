<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        $slideshowImages = [
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_2411,h_1356,x_2869,y_1683/dpr_2.0,f_auto,q_auto,c_lfill,w_1450,h_815/swa-cms/20242025_T1_HOLIDAY_KV_STILL_LIFE_MATRIX_CRASH_72_RGB/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_3031,h_1705,x_1580,y_1300/dpr_2.0,f_auto,q_auto,c_lfill,w_1450,h_815/swa-cms/20242025_T1_HOLIDAY_KV_STILL_LIFE_MILLENIA_OMNICHANNEL_72_RGB/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_3031,h_1705,x_1580,y_1300/dpr_2.0,f_auto,q_auto,c_lfill,w_1450,h_815/swa-cms/20242025_T1_HOLIDAY_KV_STILL_LIFE_MILLENIA_OMNICHANNEL_72_RGB/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_1192,h_1589,x_1449,y_1143/dpr_2.0,f_auto,q_auto,c_lfill,w_604,h_905/swa-cms/20242025_T1_HOLIDAY_KV_ON_MODEL_MILLENIA_200DPI_RGB/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_1458,h_1944,x_1526,y_1689/dpr_2.0,f_auto,q_auto,c_lfill,w_725,h_966/swa-cms/20242025_T1_HOLIDAY_KV_ON_MODEL_MATRIX_CRASH_200DPI_RGB/.jpg',
        ];


        return view('home', compact('slideshowImages'));
    }
}
