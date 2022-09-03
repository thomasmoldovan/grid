@extends('admin.index')

@section('main')
    <style>
        .square {
            width: 20px;
            height: 20px;
        }

        .fs-custom {
            font-size: 1.5rem !important;
        }

        td {
            vertical-align: middle !important;
            padding-bottom: 5px !important;
            padding-top: 5px !important;
        }
    </style>
    <main id="main" class="main">
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
            <div class="col-lg-8 p-3 mb-3 bg-white">
                <livewire:categories.category-grid/>
            </div>
        </div> 
    </main>
@endsection
