<div class="card">
    <div class="card-body mt-3">
        <div class="card-title">
            {{ $edit ? "Edit" : "Add" }} category
        </div>
        <form wire:submit.prevent="submit">
            @csrf
            <input type="hidden" id="id" name="id" wire:model.defer="category.id">
            <div class="col-md-12">
                <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="New category name" aria-describedby="add_category"
                    wire:model.defer="category.name">

                <div class="validation-message">
                    {{ $errors->first('category.name') }}
                </div>

                @if ($success)
                    <script>
                        $('#name').addClass('is-valid').change();
                    </script>
                    <div class="valid-feedback">{{ $success }}</div>
                @endif
            </div>

            <div class="col-md-12 pt-3">
                <label for="parent_id" class="form-label">Parent Category</label>
                <select id="parent_id" name="parent_id" class="form-select"
                    wire:model.defer="category.parent_id">
                    <option selected disabled value="0">Parent category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                <div class="validation-message">
                    {{ $errors->first('category.parent_id') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 pt-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="color" id="color" name="color"
                        class="form-control form-control-color" title="Choose your color"
                        value="#e66465" placeholder="Category color" aria-describedby="add_category"
                        wire:model="category.color">
                    <div class="validation-message">
                        {{ $errors->first('category.color') }}
                    </div>
                </div>

                <div class="col-md-10 pt-3">
                    <label for="icon" class="form-label">Icon <small class="text-primary">ie.
                            <code><?= htmlentities('<i class="bi bi-gem"></i>') ?></code>&nbsp;-&nbsp;<i
                                class="bi bi-gem"></i></small>
                    </label>
                    <input type="text" id="icon" name="icon" class="form-control"
                        placeholder="Category icon" aria-describedby="add_category"
                        wire:model.defer="category.icon">
                    <div class="validation-message">
                        {{ $errors->first('category.icon') }}
                    </div>
                </div>
            </div>

            <div class="text-end pt-3">
                @if ($edit)
                    <button wire:click="cancel()" type="button" id="cancel_button" class="btn btn-secondary">Cancel</button>
                @endif
                <button type="submit" id="add_category" class="btn btn-primary">{{ $edit ? "Update" : "Add" }}</button>
            </div>
        </form>
    </div>
</div>
