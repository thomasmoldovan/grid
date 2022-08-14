@extends('admin.index')

@section('main')    
    <main id="main" class="main">
        
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Locations</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Stores</li>
                        <li class="breadcrumb-item">Location</li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-8 p-3 mb-3 bg-white">
                    <livewire:location-grid/>
                </div>
                <div class="col-lg-4 p-0 ps-lg-3">
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="card-title">
                                Add location
                            </div>
                            <form method="POST" action="{{ route('locations.add') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="location_name" class="form-label">Name <b class="text-danger">*</b></label>
                                    <input type="text" id="location_name" name="location_name" class="form-control"
                                        placeholder="location name" aria-describedby="add_location_button">
                                    @error('location_name')
                                        <script>
                                            $('#location_name').addClass('is-invalid');
                                        </script>
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (session('success'))
                                        <script>
                                            $('#location_name').addClass('is-valid').change();
                                        </script>
                                        <div class="valid-feedback">{{ session('success') }}</div>
                                    @endif
                                </div>
        
                                <div class="text-end pt-3">
                                    <button type="submit" id="add_location_button" class="btn btn-primary btn-outline justify-content-md-end">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
    </main>
@endsection
