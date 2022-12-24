<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\WithToaster;
use App\Models\Category;
use App\Models\Location;
use App\Models\Store;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductComponent extends Component
{
    use WithToaster;
    use WithFileUploads;

    public $product;

    public $categories;
    public $stores;
    public $location;
    public $images;
    public $description;

    protected $listeners = [
        'updateProductDescription'
   ];

    public function mount(ProductModel $product) {
        $this->product = $product;
        $this->categories = Category::all();
        $this->stores = Store::all();
        $this->location = "";
        $this->description = "";
    }

    public function edit(ProductModel $product)
    {
        $this->product = $product;

        return;
    }

    public function render()
    {
        return view('livewire.products.product-form');
    }

    public function submit(Request $request) 
    {
        $this->validate();

        if (!empty($request->image)) {
            $validate = $request->validate([
                "image" => "mimes:jpg,png"
            ],
            [
                "image.mimes" => "Invalid image type"
            ]);

            $last_images = $this->extract_images_from_request($request);
            $this->product->image = $last_images[0];
        }

        $this->product->user_id = $request->user()->id;
        $this->product->save();

        return;
    }

    public function updatedProductStoreId() {
        $store = Store::find($this->product->store_id);
        $this->location = $store->address;
    }

    public function updateProductDescription($description) {
        $this->product->description = $description;
    }

    public function rules() {
        return [
            "product.category_id" => [
                "required",
                "numeric",
                "exists:category,id"
            ],
            "product.store_id" => [
                "required",
                "numeric",
                "exists:store,id"
            ],
            "product.name" => [
                "required",
                "min:3",
                "max:125"
            ],
            "product.description" => [
                "nullable"
            ],
            "product.quantity" => [
                "nullable",
                "min:1"
            ],
            "product.price" => [
                "required",
                "min:1"
            ],
            "product.old_price" => [
                "nullable",
                "min:1"
            ],
            "product.display_discount" => [
                "required",
                "boolean"
            ],
            "product.hot" => [
                "required",
                "boolean"
            ],
            "product.deal_of_the_day" => [
                "required",
                "boolean"
            ],
            "product.start_date" => [
                "required",
                "date"
            ],
            "product.end_date" => [
                "date"
            ]
        ];
    }
}
