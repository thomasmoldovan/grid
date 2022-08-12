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
                    <li class="breadcrumb-item">Stores</li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body mt-3">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Icon</th>
                                        <th>Color</th>
                                        <th>Name</th>
                                        <th>Parent</th>
                                        <th>Created On</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>
                                                    <div class="fs-custom {{ $category->category_icon }}"></div>
                                                </td>
                                                <td>
                                                    <div class="square"
                                                        style="background: {{ $category->category_color }} !important;">
                                                    </div>
                                                </td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->parent->category_name }}</td>
                                                <td>{{ Carbon\Carbon::parse($category->created_at) }}</td>
                                                <td class="text-end">
                                                    <a href="{{ url('category/edit/' . $category->id) }}"
                                                        class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit">
                                                        <i class="ri-edit-2-fill"></i>
                                                    </a>
                                                    <a href="{{ url('category/delete/' . $category->id) }}"
                                                        class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Disable">
                                                        <i class="ri-delete-bin-6-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="card-title">
                                Add new category
                            </div>
                            <form action="{{ route('categories.add') }}" method="POST">
                                @csrf

                                <div class="col-md-12">
                                    <label for="category_name" class="form-label">Name <b class="text-danger">*</b></label>
                                    <input type="text" id="category_name" name="category_name" class="form-control"
                                        placeholder="New category name" aria-describedby="add_category">
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
                                    <label for="parent" class="form-label">Parent Category</label>
                                    <select id="parent" name="parent" class="form-select">
                                        <option selected disabled value="0">Parent category</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 pt-3">
                                        <label for="category_color" class="form-label">Color</label>
                                        <input type="color" id="category_color" name="category_color"
                                            class="form-control form-control-color" title="Choose your color"
                                            value="#e66465" placeholder="Category color" aria-describedby="add_category">
                                    </div>

                                    <div class="col-md-10 pt-3">
                                        <label for="category_icon" class="form-label">Icon <small class="text-primary">ie.
                                                <code><?= htmlentities('<i class="bi bi-gem"></i>') ?></code>&nbsp;-&nbsp;<i
                                                    class="bi bi-gem"></i></small>
                                        </label>
                                        <input type="text" id="category_icon" name="category_icon" class="form-control"
                                            placeholder="Category icon" aria-describedby="add_category">
                                    </div>
                                </div>

                                <div class="text-end pt-3">
                                    <button type="submit" id="add_category"
                                        class="btn btn-primary btn-outline justify-content-md-end">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
