<?php

namespace App\Http\Livewire\Locations;

use App\Http\Livewire\WithToaster;
use App\Models\Location as LocationModel;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Location extends Component
{
    use WithToaster;

    public LocationModel $location;
    public $success = null;
    public $message = "";

    protected $listeners = [
        "delete" => "delete"
    ];

    protected $rules = [
        "location.name" => [
            "required",
            "unique:location",
            "min:3",
            "max:125"
        ]
    ];

    protected $messages = [
        "location.name.required" => "Please enter a location name",
        "location.name.unique" => "This location name is already in use",
        "location.name.min" => "The location name must be at least 3 characters long",
        "location.name.max" => "The location name must be less than 125 characters long"
    ];

    public function mount(LocationModel $location)
    {
        $this->location = $location;
        $this->location->name = "";
        $this->message = "";
    }

    public function render()
    {
        return view('livewire.location.location-add');
    }

    public function submit() {
        $this->validate();

        $this->location->active = 1;
        $this->location->save();
        $this->location = new LocationModel();

        $this->alert("success", "Success", "Location successfully added");

        $this->emit('pg:eventRefresh-default');
    }

    public function delete(LocationModel $location) {

        if ($location->hasStores) {

            $this->alert("error", "Error", "This location is currently in use and cannot be deleted");

            return;
        }

        $location->delete();

        $this->alert("success", "Success", "Location deleted");

        $this->emit('pg:eventRefresh-default');

        return;
    }
}
