<div class="card">
    <div class="card-body mt-3">
        <div class="card-title">
            {{ $edit ? "Edit" : "Add" }} location
        </div>
        <form wire:submit.prevent="submit">
            @csrf
            <input type="hidden" id="name" name="name" wire:model.defer="location.id">
            <div class="col-md-12">
                <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="location name" aria-describedby="add_button"
                    wire:model.defer="location.name">

                <div class="validation-message">
                    {{ $errors->first('location.name') }}
                </div>
                
                @if ($success)
                    <script>
                        $('#name').addClass('is-valid').change();
                    </script>
                    <div class="valid-feedback">{{ $success }}</div>
                @endif
            </div>

            <div class="text-end pt-3">
                @if ($edit)
                    <button wire:click="cancel()" type="button" id="cancel_button" class="btn btn-secondary">Cancel</button>
                @endif
                <button type="submit" id="add_location" class="btn btn-primary">{{ $edit ? "Update" : "Add" }}</button>
            </div>
        </form>
    </div>
</div>
