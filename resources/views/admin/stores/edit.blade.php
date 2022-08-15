@extends('admin.index')

@section('main')
    <main id="main" class="main">
        <div class="container-fluid">
            <div class="pagetitle">
                <h1>Stores</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Stores</li>
                        <li class="breadcrumb-item">Store</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="card-title">
                                Edit store
                            </div>
                            <form action="{{ route('stores.update', $store->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $store->name }}" aria-describedby="update_button">
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
                                            <option value="{{ $location->id }}"
                                                {{ $store->location_id == $location->id ? 'selected' : '' }}>
                                                {{ $location->name }}</option>
                                            }
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="text" id="link" name="link" class="form-control"
                                        placeholder="Store link" aria-describedby="add_button"
                                        value="{{ $store->link }}">
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Store address" aria-describedby="add_button"
                                        value="{{ $store->address }}">
                                </div>

                                <div class="form-check form-switch mt-3">
                                    <input id="display" name="display" class="form-check-input" type="checkbox"
                                        {{ $store->display ? 'checked' : '' }}>
                                    <label class="form-check-label" for="display">Display in stores</label>
                                </div>

                                <div class="col-md-12 pt-3">
                                    <label for="name" class="form-label">Image <b class="text-danger">*</b></label>
                                    <input type="file" id="image" name="image" class="form-control"
                                        value="Store image" aria-describedby="update_button">
                                    @error('image')
                                        <script>
                                            $('#image').addClass('is-invalid').change();
                                        </script>
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center pt-3">
                                    <img src="{{ asset($store->image) }}" alt=""
                                        class="img-fluid border border-dark">
                                </div>

                                <div class="text-end pt-3">
                                    <button type="submit" id="update_button"
                                        class="btn btn-primary btn-outline justify-content-md-end">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
