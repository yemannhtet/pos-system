@extends('customer.layouts.master')

@section('content')
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <form action="{{ route('shopList') }}" method="get">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" value="{{ request('searchKey') }}"
                                        name="searchKey" placeholder="keywords">
                                    <button class="input-group-text p-3"><i class="fa fa-search"></i></button>
                                </div>
                            </form>



                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-5">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <ul>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('shopList') }}">
                                                            <i class="fas fa-apple-alt me-2"></i>All Categories
                                                        </a>
                                                    </div>
                                                </li>
                                                @foreach ($categories as $item)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="{{ route('shopList', $item->id) }}">
                                                                <i class="fas fa-apple-alt me-2"></i>{{ $item->name }}
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <form action="{{ route('shopList') }}" method="get">
                                            @csrf
                                            <input type="text" placeholder="Minium Price"
                                                value="{{ request('minPrice') }}" name="minPrice" class="form-control my-2">
                                            <input type="text" placeholder="Maxium Price"
                                                value="{{ request('maxPrice') }}" name="maxPrice"
                                                class="form-control my-2 ">
                                            <input type="submit" value="Filter" class=" btn btn-secondary">
                                        </form>

                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @if ($products->isEmpty())
                                    <p>No products found for this category.</p>
                                @else
                                    <div class="row">
                                        @foreach ($products as $p)
                                            <div class="col-md-6 col-lg-6 col-xl-4">
                                                <!-- Updated Card Design -->
                                                <div class="card shadow-sm border-0 rounded position-relative fruite-item">
                                                    <div class="p-3">
                                                        <a href="{{ route('details', $p->id) }}">
                                                            <img src="{{ asset('images/' . $p->image) }}"
                                                                 class="img-fluid w-100 rounded-top"
                                                                 alt="{{ $p->name }}"
                                                                 style="height: 230px; object-fit: contain;">
                                                        </a>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                             style="top: 10px; left: 10px;">
                                                            {{ $p->category_name }}
                                                        </div>
                                                    </div>
                                                    <div class="p-4 border-top-0">
                                                        <h5 class="text-dark fw-bold">{{ $p->name }}</h5>
                                                        <p class="text-muted">{{ implode(' ', array_slice(explode(' ', $p->description), 0, 20)) }}{{ str_word_count($p->description) > 20 ? '...' : '' }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="text-dark fs-5 fw-bold mb-0"><i class="fa-solid fa-money-bill-wave"></i> {{ $p->price }} (MMK)</p>
                                                        </div>
                                                        <!-- Quantity and Add to Cart Section -->
                                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                                            <form action="{{ route('addToCart') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                                                <div class="input-group quantity" style="width: 100px;">
                                                                    <div class="input-group-btn">
                                                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-sm text-center border-0" name="qty" value="1">
                                                                    <div class="input-group-btn">
                                                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 mt-3">
                                                                    <i class="fa fa-shopping-bag me-2"></i> Add to cart
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-start mt-5">
                                        {{ $products->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Fruits Shop End-->

@endsection
