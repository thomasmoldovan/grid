<?php

namespace App\Http\Livewire\Locations;

use App\Http\Livewire\WithToaster;
use App\Models\Location as LocationModel;
use Livewire\Component;

class LocationComponent extends Component
{
    use WithToaster;

    public LocationModel $location;

    public $edit = false;
    public $success = null;

    protected $listeners = [
        "edit" => "edit",
        "delete" => "delete"
    ];

    public function mount(LocationModel $location)
    {
        $this->location = $location;
        $this->location->name = "";
        $this->location->active = 0;
        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.locations.location-form');
    }

    public function submit() 
    {
        $this->validate();
        $updated = $this->location->id > 0;

        $this->location->save();

        $this->mount(new LocationModel());
        $this->alert("success", "Success", "Location successfully ".($updated ? "updated" : "added"));
        $this->emit('pg:eventRefresh-default');

        return;
    }

    public function edit(LocationModel $location) 
    {
        $this->location = $location;
        $this->edit = true;

        return;
    }

    public function delete(LocationModel $location) 
    {
        if ($location->hasStores) {
            $this->alert("error", "Error", "This location is currently in use and cannot be deleted");
            return;
        }

        $location->delete();

        $this->alert("success", "Success", "Location deleted");
        $this->emit('pg:eventRefresh-default');

        return;
    }

    public function cancel() 
    {
        $this->mount(new LocationModel());
    }

    public function rules() 
    {
        return [
            "location.name" => [
                "required",
                "unique:location",
                "min:3",
                "max:125"
            ]
        ];
    }

    public function nessages()
    {
        return [
            "location.name.required" => "Please enter a location name",
            "location.name.unique" => "This location name is already in use",
            "location.name.min" => "The location name must be at least 3 characters long",
            "location.name.max" => "The location name must be less than 125 characters long"
        ];
    }
}
