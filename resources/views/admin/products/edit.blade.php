@extends('admin/admin_master')

@section('admin')

<style>
    .image-pr {
        margin-right: 5px;
    }
    .ribbon-container {
        position: relative;
    }

    .ribbon-text {
        background-color: #bd2036;
        color: #fff;
        font-size: .625rem;
        font-weight: 700;
        left: 0;
        padding: 0.25rem 0.5rem;
        position: absolute;
        z-index: 1;
    }
</style>

<div class="pagetitle">
    <h1>Edit Product</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item">Edit</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Edit product
                    </div>
                    <form action="{{ url('/product/update/'.$product->id) }}" method="POST" 
                        class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category <b
                                    class="text-danger">*</b></label>
                            <select id="category" name="category" class="form-select" required>
                                <option selected disabled value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option {{ $product->category_id == $category->id ? "selected" : ""; }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">You must select a category</div>
                        </div>
                        <div class="col-md-4">
                            <label for="store" class="form-label">Store <b class="text-danger">*</b></label>
                            <select id="store" name="store" class="form-select" required>
                                <option selected disabled value="">Select a store</option>
                                @foreach ($stores as $store)
                                    <option {{ $product->store_id == $store->id ? "selected" : ""; }} value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">You must select a store</div>
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label">Location</label>
                            <input id="location" name="location" type="text" class="form-control" value="" readonly>
                            <div class="invalid-feedback">Address field cannot be empty</div>
                        </div>

                        <div class="col-lg-6">
                            <div class="">
                                <label for="name" class="form-label">Product Name <b
                                        class="text-danger">*</b></label>
                                <input id="name" name="name" type="text" class="form-control" value="{{ $product->product_name }}" required>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-4">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input id="quantity" name="quantity" class="form-control" value="{{ $product->product_quantity }}">
                                </div>
                                <div class="col-lg-4">
                                    <label for="price" class="form-label">Price <b
                                            class="text-danger">*</b></label>
                                    <input id="price" name="price" type="text" class="form-control" value="{{ $product->product_price }}" required>
                                    <div class="invalid-feedback">
                                        Please provide a price.
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="old_price" class="form-label">Old Price</label>
                                    <input id="old_price" name="old_price" type="text" class="form-control" value="{{ $product->product_old_price }}">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-4">
                                    <input id="display_discount" name="display_discount" class="form-check-input me-1"
                                        type="checkbox" {{ $product->display_discount ? "checked" : "" }}>
                                    <label class="form-check-label" for="display_discount">
                                        Display discount
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input id="hot" name="hot" class="form-check-input me-1" type="checkbox" {{ $product->hot ? "checked" : "" }}>
                                    <label class="form-check-label" for="hot">
                                        Hot
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input id="deal_of_the_day" name="deal_of_the_day" class="form-check-input me-1"
                                        type="checkbox" {{ $product->deal_of_the_day ? "checked" : "" }}>
                                    <label class="form-check-label" for="deal_of_the_day">
                                        Deal of the day
                                    </label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-lg-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input id="start_date" name="start_date" type="datetime"
                                        class="startdate form-control" value="{{ $product->start_date }}" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input id="end_date" name="end_date" type="datetime"
                                        class="enddate form-control" value="{{ $product->end_date }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="pt-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="product_image" name="product_image[]" class="form-control"
                                    placeholder="Product image" value="{{ $product->product_image }}" multiple="">
                            </div>
                            <div class="d-flex pt-3">
                                @foreach ($product->images as $image)
                                    <div class="image-pr">
                                        @if ($image->default == true)
                                            <span class="ribbon-container">
                                                <span class="ribbon-text">
                                                    Default
                                                </span>
                                            </span>
                                        @endif
                                        <img src="/laravela/public/images/products/{{ $image->name }}" alt="" data-id="{{ $product->id }}" height="128px" width="128px" class="img-fluid img-thumbnail image-pr product-image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="description" class="form-label">Product Description <b class="text-danger">*</b></label>
                            <textarea id="description" name="description" class="tinymce-editor">
                                {{ $product->product_description }}
                            </textarea>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary mt-3 ml-0" type="button">Generate codes</button>
                            <button class="btn btn-primary mt-3" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    label {
        font-weight: bold;
    }
    td {
        font-size: 0.9em;
    }
</style>

<script src="{{ asset('/js/products/products.js') }}"></script>

@endsection
