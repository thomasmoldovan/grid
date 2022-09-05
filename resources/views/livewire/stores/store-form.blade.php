<div class="card">
    <div class="card-body mt-3">
        <div class="card-title">
            {{ $edit ? "Edit" : "Add" }} store
        </div>
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id" name="id" wire:model.defer="store.id">
            <div class="col-md-12">
                <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="Store name" aria-describedby="add_store"
                    wire:model.defer="store.name">

                <div class="validation-message">
                    {{ $errors->first('store.name') }}
                </div>

                @if ($success)
                    <script>
                        $('#name').addClass('is-valid').change();
                    </script>
                    <div class="valid-feedback">{{ $success }}</div>
                @endif
            </div>

            <div class="col-md-12 pt-3">
                <label for="location_id" class="form-label">Location <b class="text-danger">*</b></label>
                <select id="location_id" name="location_id" class="form-select"
                    wire:model.defer="store.location_id">
                    @foreach ($locations as $key => $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
                <div class="validation-message">
                    {{ $errors->first('store.location_id') }}
                </div>
            </div>

            <div class="col-md-12 pt-3">
                <label for="link" class="form-label">Link <b class="text-danger">*</b></label>
                <input type="text" id="link" name="link" class="form-control"
                    placeholder="Store link" aria-describedby="add_store"
                    wire:model.defer="store.link">
                <div class="validation-message">
                    {{ $errors->first('store.link') }}
                </div>
            </div>

            <div class="col-md-12 pt-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control"
                    placeholder="Store address" aria-describedby="add_store"
                    wire:model.defer="store.address">
                <div class="validation-message">
                    {{ $errors->first('store.address') }}
                </div>
            </div>

            <div class="form-check form-switch mt-3">
                <input id="display" name="display" class="form-check-input" type="checkbox"
                    value="on" checked
                    wire:model.defer="store.display">
                <label class="form-check-label" for="display">Display in stores</label>
            </div>

            <div class="col-md-12 pt-3">
                <label for="image" class="form-label">Image <b class="text-danger">*</b></label>
                <input type="file" id="image" name="image" class="form-control"
                    placeholder="Store image"
                    wire:model.defer="store.image">
                <div class="validation-message">
                    {{ $errors->first('store.image') }}
                </div>
            </div>

            <div class="text-end pt-3">
                @if ($edit)
                    <button wire:click="cancel()" type="button" id="cancel_button" class="btn btn-secondary">Cancel</button>
                @endif
                <button type="submit" id="add_store" class="btn btn-primary">{{ $edit ? "Update" : "Add" }}</button>
            </div>
        </form>
    </div>
</div>