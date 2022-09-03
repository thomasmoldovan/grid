<div class="card">
    <div class="card-body mt-3">
        <div class="card-title">
            Add location
        </div>
        <form wire:submit.prevent="submit">
            @csrf
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
                <button type="submit" id="add_button" class="btn btn-primary btn-outline justify-content-md-end">Add</button>
            </div>
        </form>
    </div>
</div>
