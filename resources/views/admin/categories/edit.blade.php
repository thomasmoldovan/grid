@extends('admin.index')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Stores</li>
                    <li class="breadcrumb-item">Categories</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="card-title">
                            Edit category
                        </div>
                        <form action="{{ route('categories.update', $current_category->id) }}" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <label for="category_name" class="form-label">Name <b class="text-danger">*</b></label>
                                <input type="text" id="category_name" name="category_name" class="form-control"
                                    value="{{ $current_category->category_name }}"
                                    aria-describedby="update_category_button">
                                @error('category_name')
                                    <script>
                                        $('#category_name').addClass('is-invalid');
                                    </script>
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (session('success'))
                                    <script>
                                        $('#category_name').addClass('is-valid').change();
                                    </script>
                                    <div class="valid-feedback">{{ session('success') }}</div>
                                @endif
                            </div>

                            <div class="col-md-12 pt-3">
                                <label for="parent_id" class="form-label">Parent Category</label>
                                <select id="parent_id" name="parent_id" class="form-select">
                                    <option selected disabled value="0">Parent category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-2 pt-3">
                                    <label for="category_color" class="form-label">Color</label>
                                    <input type="color" id="category_color" name="category_color"
                                        class="form-control form-control-color" title="Choose your color"
                                        value="{{ $current_category->category_color }}" placeholder="Category color"
                                        aria-describedby="add_category">
                                </div>

                                <div class="col-md-10 pt-3">
                                    <label for="category_icon" class="form-label">Icon <small class="text-primary">ie.
                                            <code><?= htmlentities('<i class="bi bi-gem"></i>') ?></code>&nbsp;-&nbsp;<i
                                                class="bi bi-gem"></i></small>
                                    </label>
                                    <input type="text" id="category_icon" name="category_icon" class="form-control"
                                        value="{{ $current_category->category_icon }}" placeholder="Category icon"
                                        aria-describedby="add_category">
                                </div>
                            </div>

                            <div class="text-end pt-3">
                                <button type="submit" id="update_category_button"
                                    class="btn btn-primary btn-outline justify-content-md-end">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
