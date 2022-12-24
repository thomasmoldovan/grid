<div>
    <form wire:submit.prevent="submit" id="product-add-form" method="POST" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-md-4">
            <label for="category" class="form-label">Category <b class="text-danger">*</b></label>
            <select wire:model="product.category_id" id="category" name="category" class="form-select" required>
                <option selected value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">You must select a category</div>
            <div class="validation-message">
                {{ $errors->first('product.category_id') }}
            </div>
        </div>
        <div class="col-md-4">
            <label for="store" class="form-label">Store <b class="text-danger">*</b></label>
            <select wire:model="product.store_id" id="store" name="store" class="form-select" required>
                <option selected value="">Select a store</option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">You must select a store</div>
        </div>
        <div class="col-md-4">
            <label for="location" class="form-label">Store Address</label>
            <input wire:model="location" id="location" name="location" type="text" class="form-control" value="" readonly disabled>
            <div class="invalid-feedback">Address field cannot be empty</div>
        </div>
        <div class="col-lg-6">
            <div class="">
                <label for="name" class="form-label">Product Name <b class="text-danger">*</b></label>
                <input wire:model="product.name" id="name" name="name" type="text" class="form-control" required>
                <div class="invalid-feedback">
                    Please provide a product name.
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input wire:model="product.quantity" id="quantity" name="quantity" type="text" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="price" class="form-label">Price <b class="text-danger">*</b></label>
                    <input wire:model="product.price" id="price" name="price" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Please provide a price.
                    </div>
                </div>
                <div class="col-lg-4">
                    <label for="old_price" class="form-label">Old Price</label>
                    <input wire:model="product.old_price" id="old_price" name="old_price" type="text" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4">
                    <input wire:model="product.display_discount" id="display_discount" name="display_discount" class="form-check-input me-1" type="checkbox">
                    <label class="form-check-label" for="display_discount">
                        Display discount
                    </label>
                </div>
                <div class="col-lg-4">
                    <input wire:model="product.hot" id="hot" name="hot" class="form-check-input me-1" type="checkbox">
                    <label class="form-check-label" for="hot">
                        Hot
                    </label>
                </div>
                <div class="col-lg-4">
                    <input wire:model="product.deal_of_the_day" id="deal_of_the_day" name="deal_of_the_day" class="form-check-input me-1" type="checkbox">
                    <label class="form-check-label" for="deal_of_the_day">
                        Deal of the day
                    </label>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input wire:model="product.start_date" id="start_date" name="start_date" type="datetime" class="startdate form-control" autocomplete="off">
                </div>
                <div class="col-lg-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input wire:model="product.end_date" id="end_date" name="end_date" type="datetime" class="enddate form-control" autocomplete="off">
                </div>
            </div>
            <div class="pt-3">
                <label for="image" class="form-label">Image <b class="text-danger">*</b></label>
                <input wire:ignore wire:model="images" type="file" id="product_image" name="product_image[]" class="form-control" placeholder="Product image" required multiple>
                <div class="invalid-feedback">You must select a image</div>
                <div class="validation-message">
                    {{ $errors->first('product.image') }}
                </div>
            </div>
        </div>
        <div class="col-lg-6" wire:ignore>
            <label for="description" class="form-label">Product Description <b class="text-danger">*</b></label>
            <input type="hidden" id="description" wire:model="description">
            <textarea wire:model="product.description" id="description" name="description" class="tinymce-editor">
                <p>Product description</p>
            </textarea>
        </div>
        <div class="">
            <div class="float-end">
                <button wire:click="edit(1)" class="btn btn-primary mt-3 ml-0" type="button">Generate codes</button>
                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </div>
        </div>
    </form>

    <script src="{{ asset('/assets/js/products/products.js') }}"></script>
    <script>
        $(document).ready(function() {
            tinyMCE.get()[0].on("keyup", function() {
                // debugger;
                Livewire.emit("updateProductDescription", tinyMCE.get()[0].getContent());
                // $("#echotext").val(tinyMCE.get()[0].getContent());
                // window.livewire.set('product.description', tinyMCE.get()[0].getContent());
            });
        });
    </script>
</div>
