@extends('admin.index')

@section('main')    
    <main id="main" class="main">        
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Categories</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-9 p-3 mb-3 bg-white">
                    <livewire:categories.category-grid/>
                </div>
                <div class="col-lg-3 p-0 ps-lg-3">
                    <livewire:categories.category-component/>
                </div>
            </div>            
        </div>        
    </main>
@endsection
