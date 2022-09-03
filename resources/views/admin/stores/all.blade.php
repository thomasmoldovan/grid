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
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="card-title">
                                Add store
                            </div>
                            <form action="{{ route('stores.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Store name" aria-describedby="add_button">
                                    @error('name')
                                        <script>
                                            $('#name').addClass('is-invalid');
                                        </script>
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (session('success'))
                                        <script>
                                            $('#name').addClass('is-valid').change();
                                        </script>
                                        <div class="valid-feedback">{{ session('success') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="location_id" class="form-label">Location <b
                                            class="text-danger">*</b></label>
                                    <select id="location_id" name="location_id" class="form-select">
                                        @foreach ($locations as $key => $location)
                                            {
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            }
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="link" class="form-label">Link <b class="text-danger">*</b></label>
                                    <input type="text" id="link" name="link" class="form-control"
                                        placeholder="Store link" aria-describedby="add_button">
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Store address" aria-describedby="add_button">
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input id="display" name="display" class="form-check-input" type="checkbox"
                                        value="on" checked>
                                    <label class="form-check-label" for="display">Display in stores</label>
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="image" class="form-label">Image <b class="text-danger">*</b></label>
                                    <input type="file" id="image" name="image" class="form-control"
                                        placeholder="Store image">
                                    @error('image')
                                        <script>
                                            $('#image').addClass('is-invalid').change();
                                        </script>
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-end pt-3">
                                    <button type="submit" id="add_button"
                                        class="btn btn-primary btn-outline justify-content-md-end">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
