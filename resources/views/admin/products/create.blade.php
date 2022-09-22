@extends('admin.index')

@section('main')
    <main id="main" class="main">
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Create Products</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 p-3 mb-3 bg-white">
                    <livewire:products.product-component/>
                </div>
            </div>
        </div>
    </main>
@endsection