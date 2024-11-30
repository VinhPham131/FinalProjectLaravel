@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<x-breadcrumbs />
<style>
    .container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

.container img {
  width: 100%;
  height: auto;
  object-fit: cover;
}
</style>

<section class="grid justify-center">
<div class="flex flex-col max-w-[1200px] tablet:mx-[100px] laptop:mx-[200px] phone:mx-[20px]">
    <span class="text-4xl mb-8 font-garamond font-bold text-center">About Us</span>
    <span class="text-[20px] font-garamond text-center mb-8 ">Who we are and why we do what we do!</span>
    <span class="text-[15px] font-garamond  mb-8  text-gray-500">LBJ Jewelry is a renowned brand in the jewelry industry, driven by passion and dedication to every intricate detail. Established in 2024, LBJ has quickly solidified its position in the market thanks to the quality of its products and sophisticated designs.</span>
    <span class="text-[25px] font-garamond font-bold mb-8"><u class="underline">Top trends</u></span>
    <section class="grid justify-center tablet:mx-[80px] laptop:mx-[150px] mb-8">
        <video class="h-full w-full rounded-lg max-w-[1100px] items-center object-cover" autoreplay autoPlay muted>
            <source src="/vid/vid1.mp4" type="video/mp4"/>
        </video>
    </section>
    <p class="mb-3 font-garamond text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start">
    At LBJ Jewelry, we take immense pride in not just following trends but leading the way in shaping the future of the jewelry industry. Our dedication to innovation, artistry, and excellence allows us to stay ahead of the curve, creating pieces that set benchmarks for elegance and sophistication. With a keen eye on emerging styles and a commitment to timeless beauty, LBJ’s collections are a perfect blend of modern trends and enduring classics. Each design reflects our vision of redefining jewelry as more than just an accessory—it's a statement of style, individuality, and grace.

</p>
    <ul class="text-[15px] font-garamond ml-5 mb-8">
        <li><strong class="font-garamond text-gray-900 dark:text-white">1. Sustainable Jewelry </strong></li>
        <li><strong class="font-garamond text-gray-900 dark:text-white">2. Minimalist Designs</strong></li>
    </ul>
    <span class="text-[25px] font-garamond font-bold mb-8"><u class="underline">Produced with care</u></span>
    <section class="grid justify-center tablet:mx-[80px] laptop:mx-[150px] mb-8">
        <video class="h-full w-full rounded-lg max-w-[1100px] items-center object-cover" autoreplay autoPlay muted>
            <source src="/vid/vid2.mp4" type="video/mp4"/>
        </video>
    </section>
    <p class="mb-3 font-garamond text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start">
    LBJ takes immense pride in its extensive and diverse jewelry collections, offering a wide range of exquisite pieces that include rings, necklaces, earrings, and bracelets. Each creation is a testament to meticulous craftsmanship, where every detail is thoughtfully considered to ensure unparalleled quality and beauty. The designs seamlessly blend classic sophistication with contemporary innovation, resulting in timeless pieces that resonate with both tradition and modernity. More than just adornments, LBJ’s jewelry serves as wearable art, embodying elegance and creativity. Every piece is crafted to enhance the wearer’s natural beauty, inspire confidence, and make a bold statement about individuality and style. With LBJ, jewelry becomes a celebration of artistry, emotion, and self-expression, making each piece a cherished treasure.
</p>
</div>
<div class=" justify-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <div>
        <img class="h-auto max-w-[90%] rounded-lg" src="https://asset.swarovski.com/images/c_crop,g_xy_center,w_2688,h_3584,x_1930,y_1792/dpr_2.0,f_auto,q_auto,c_lfill,w_1024,h_1365/swa-cms/B2C_ABOUTUS_VISUAL-HERITAGE-OLDEST-PROD-CATALOTUE_NP_GL/.jpg" alt="">
    </div>
    <div>
        <img class="h-auto max-w-[90%] rounded-lg" src="https://asset.swarovski.com/images/c_crop,g_xy_center,w_774,h_1032,x_749,y_516/dpr_2.0,f_auto,q_auto,c_lfill,w_768,h_1024/swa-cms/B2C_ABOUTUS_VISUAL-HERITAGE-1ST-SWAROVSKI-SHOP-1980_NP_GL/.jpg" alt="">
    </div>
    <div>
        <img class="h-auto max-w-[90%] rounded-lg" src="https://asset.swarovski.com/images/c_crop,g_xy_center,w_2473,h_3297,x_1957,y_1649/dpr_2.0,f_auto,q_auto,c_lfill,w_1024,h_1365/swa-cms/B2C_ABOUTUS_VISUAL-HERITAGE-ATELIER-SWAROVSKI-COLLECTION-2010_SL_GL/.jpg" alt="">
    </div>
    <div>
</section>


<script type="module" src="/src/resources/scripts/menu.js"></script>

@endsection