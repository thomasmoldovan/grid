<?php

namespace App\Http\Livewire\Locations;

use App\Models\Location as LocationModel;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Location extends Component
{

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

        $this->emit('pg:eventRefresh-default');
    }

    public function delete(LocationModel $location) {

        if ($location->hasStores) {
            $toaster_message = [
                "status" => "error",
                "title" => "Error",
                "message" => "This location is currently in use and cannot be deleted"
            ];
            $this->emit("toaster_message", $toaster_message);
            return;
        }

        $location->delete();
        $toaster_message = [
            "status" => "success",
            "title" => "Success",
            "message" => "Location deleted"
        ];
        $this->emit("toaster_message", $toaster_message);

        $this->emit('pg:eventRefresh-default');

        return;
    }
}
