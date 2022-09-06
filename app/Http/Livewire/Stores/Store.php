<?php

namespace App\Http\Livewire\Stores;

use App\Http\Livewire\WithToaster;
use App\Models\Location;
use App\Models\Store as StoreModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class Store extends Component
{
    use WithToaster;
    use WithFileUploads;

    public $store;
    public $location;

    public $image;
    public $unique_image_id;
    public $preview_url = "";
    public $preview_file = "";

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

        $this->image = "";
        $this->preview_url = "";
        $this->preview_file = "";
        $this->unique_image_id = hexdec(uniqid());

    }

    public function render()
    {
        return view('livewire.stores.store-form');
    }

    public function submit() 
    {
        $this->validate();

        // Image validation
        if (!$this->edit || ($this->edit && $this->image)) {
            $this->validate([
                "image" => ["required", 'image', "mimes:jpg,jpeg,png"]
            ]);
        }

        if (!empty($this->image)) {
            // Remove previously saved image
            try {
                unlink($this->store->image);
            } catch (\Throwable $th) {}

            $image_extension = strtolower($this->image->getClientOriginalExtension());
            $image_name = $this->unique_image_id.".".$image_extension;
            $this->store->image = $this->image->storeAs("images/stores", $image_name);
        }

        $this->store->save();

        // Remove the temporary image file
        if (!empty($this->image)) {
            $temp_file = "livewire-tmp/".$this->image->getFilename();
            try {
                unlink($temp_file);
            } catch (\Throwable $th) {}
        }

        $this->alert("success", "Success", "Store successfully ".($this->edit ? "updated" : "added"));
        $this->refreshAll();

        return;
    }

    public function updatedImage() {
        // Remove previous preview file
        try {
            unlink($this->preview_file);
        } catch (\Throwable $th) {}

        // New preview file
        $this->preview_url = $this->image->temporaryUrl();
        $this->preview_file = "livewire-tmp/".$this->image->getFilename();
    }

    public function edit(StoreModel $store) 
    {
        $this->edit = true;
        $this->store = $store;
        $this->preview_file = $store->image;

        return;
    }

    public function delete(StoreModel $store) 
    {
        if ($store->hasStores) {
            $this->alert("error", "Error", "This location is currently in use and cannot be deleted");
            return;
        }

        $store->delete();

        try {
            unlink($store->image);
        } catch (\Throwable $th) {}

        $this->alert("success", "Success", "Location deleted");        
        $this->refreshAll();

        return;
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
                "unique:store,name,".$this->store->id.",id",
                "min:3",
                "max:125"
            ],
            "store.location_id" => [
                "required",
                "numeric",
                "exists:location,id"
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
