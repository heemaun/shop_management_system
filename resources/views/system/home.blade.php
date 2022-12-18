<div class="home">
    <main>
        <img src="{{ asset('images/main_img.jpg') }}" alt="main-image" width="500px" height="auto">
    </main>

    <section>
        @foreach ($categories as $category)
        <h3>{{ $category->name }}</h3>
        @foreach ($category->products as $product)
        <span>{{ $product->name }}</span>
        @endforeach
        @endforeach
    </section>

    <footer>
        Email: heemaun@gmail.com
        Phone: 01751430596
        Address: Suihary-Ramnagor Road, Suihary, Dinajpur -5200
    </footer>
</div>
