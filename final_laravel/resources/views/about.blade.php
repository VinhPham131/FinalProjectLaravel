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
.about-section {
            position: relative;
            width: 750px;
            margin: auto;
        }

        .about-image {
            width: 100%;
            border-radius: 8px;
        }

        .about-text {
            position: absolute;
            top: 30%;
            left: 10%;
            transform: translate(-10%, -30%);
            color: #000; /* Màu chữ */
            text-align: left;
        }

        .about-text h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .about-text p {
            font-size: 1rem;
            color: #333;
        }
</style>

<section class="grid justify-center">
<div class="flex flex-col max-w-[1200px] tablet:mx-[100px] laptop:mx-[200px] phone:mx-[20px]">
<div class="about-section">
<div class="about-section">
        <!-- Hình ảnh -->
        <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462642174_2506324549578114_5617679609892770652_n.jpg?stp=dst-jpg_p526x395_tt6&_nc_cat=111&ccb=1-7&_nc_sid=0024fc&_nc_ohc=5HUNq1FKNrUQ7kNvgET5MZ_&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QFu_l7rBpzQKH46aMM5poxl_KPwZ5CtoprJuF__-fvVQg&oe=67750D77" alt="About Us" class="about-image">

        <!-- Chữ nằm trên ảnh -->
        <div class="about-text">
            <h1>About Us</h1>
            <p>The single source of information on the Canadian jewellery industry since 1918.</p>
        </div>
    </div>
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
<div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 lg:px-20 max-w-screen-xl mx-auto">
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

@endsection.