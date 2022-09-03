@extends('admin.index')

@section('main')    
    <main id="main" class="main">
        <livewire:toaster-component/>
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Locations</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item">Locations</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-8 p-3 mb-3 bg-white">
                    <livewire:locations.location-grid/>
                </div>
                <div class="col-lg-4 p-0 ps-lg-3">
                    <livewire:locations.location/>
                </div>
            </div>            
        </div>        
    </main>
@endsection
