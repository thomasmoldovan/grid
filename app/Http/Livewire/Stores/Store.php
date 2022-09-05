<?php

namespace App\Http\Livewire\Stores;

use App\Http\Livewire\WithImages;
use App\Http\Livewire\WithToaster;
use App\Models\Location;
use App\Models\Store as StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Store extends Component
{
    use WithToaster;
    use WithImages;
    use WithFileUploads;

    public $store;
    public $location;

    public $edit = false;
    public $success = null;

    protected $listeners = [
        "edit" => "edit",
        "delete" => "delete"
    ];

    public function mount(StoreModel $store)
    {
        $this->store = $store;
        $this->locations = Location::all();
        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.stores.store-form');
    }

    public function submit(Request $request) 
    {
        // $this->validate();
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        $updated = $this->store->id > 0;

        $uploaded_image = $this->extract_image_from_request($request);

        $this->store->save();

        $this->alert("success", "Success", "Store successfully ".($updated ? "updated" : "added"));

        $this->refreshAll();

        return;
    }

    public function edit(StoreModel $store) 
    {
        $this->edit = true;
        $this->store = $store;

        return;
    }

    public function delete(StoreModel $store) 
    {
        if ($store->hasStores) {
            $this->alert("error", "Error", "This location is currently in use and cannot be deleted");
            return;
        }

        $store->delete();

        $this->alert("success", "Success", "Location deleted");
        
        $this->refreshAll();

        return;
    }

    public function cancel() 
    {
        $this->refreshAll();
    }

    public function refreshAll() 
    {
        $this->mount(new StoreModel());        
        $this->emit('refreshComponent');
        $this->emit('pg:eventRefresh-default');
    }

    public function rules() 
    {
        return [
            "store.name" => [
                "required",
                "unique:store",
                "min:3",
                "max:125"
            ],
            "store.location_id" => [
                "required",
                "numeric",
                "exists:location,id"
            ],
            "store.image" => [
                "required",
                'image',
                "mimes:jpg,jpeg,png"
            ],
            "store.display" => [
                "boolean"
            ],
            "store.link" => [
                "required",
                "url"
            ],
            "store.address" => [
                "min:3",
                "max:125",
                "nullable"
            ]
        ];
    }

    public function messages()
    {
        return [
            "store.name.required" => "You must enter a store name",
            "store.name.unique" => "Store already exists",
            "store.name.max" => "Store name to long. Maximum 125 characters allowed",
            "store.name.min" => "Store name to short. Enter at least 3 characters",
            "store.image.required" => "Store image required",
            "store.image.mimes" => "Invalid image type"
        ];
    }
}
