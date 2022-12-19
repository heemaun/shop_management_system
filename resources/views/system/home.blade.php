<div class="home">
    <main>
        <img src="{{ asset('images/main_bg.jpg') }}" alt="main-image">
        <div class="headline">
            <h1>Zamans' Cafe</h1>
            <p>Best cafe of the town</p>
        </div>
    </main>

    <section>
        @foreach ($categories as $category)
            <div class="category">
                <h3>{{ $category->name }}</h3>

                @foreach ($category->products as $product)

                <div class="product" data-href="{{ route('products.show',$product->id) }}">

                    <span class="name">{{ $product->name }}</span>
                    <img src="{{ asset('images/'.$product->picture) }}" alt="no image">
                    <span class="price">{{ $product->selling_price }} Tk</span>
                    @if (checkLogin())
                    <a href="{{ route('products.show',$product->id) }}" class="btn btn-outline-primary hide">Add to cart</a>
                    @endif

                </div>

                @endforeach
            </div>
        @endforeach
    </section>

    <footer>
        <span id="footer_email"><i class="fa-solid fa-envelope"></i> heemaun@gmail.com</span>
        <span id="footer_phone"><i class="fa-solid fa-phone"></i> 01751430596</span>
        <span id="footer_address"><i class="fa-solid fa-location-dot"></i> Suihary-Ramnagor Road, Suihary, Dinajpur -5200</span>
    </footer>

</div>

<section id="home_product_show" class="home-product-show hide">
    <div class="columns">
        <img src="{{ asset('images/'.$product->picture) }}" id="home_product_show_img" alt="Product Image">
    </div>

    <div class="columns">
        <span id="home_product_show_name" class="name">Lorem, ipsum dolor</span>
        <span id="home_product_show_category" class="category">Lorem dolor</span>
        <span id="home_product_show_price" class="price">Price</span>
        <span id="home_product_show_status" class="status">Status</span>
        @if (checkLogin())
        <a href="#" id="home_product_show_add_to_cart" class="btn btn-outline-info">Add to cart</a>
        @endif
    </div>

    <span id="home_product_show_close" class="home-product-show-close"><i class="fa-solid fa-xmark"></i></span>
</section>

<section id="view_image" class="view-image hide">
    <img src="" alt="view image">
    <span id="view_image_close" class="view-image-close"><i class="fa-solid fa-xmark"></i></span>
</section>
