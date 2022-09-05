@extends('admin.index')

@section('main')
    <main id="main" class="main">
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Stores</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item">Stores</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-9 p-3 mb-3 bg-white">
                    <livewire:stores.store-grid />
                </div>
                <div class="col-lg-3 p-0 ps-lg-3">
                    <livewire:stores.store />
                </div>
            </div>
        </div>
    </main>
@endsection
