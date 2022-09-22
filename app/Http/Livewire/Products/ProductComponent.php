<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\WithToaster;
use App\Models\Category;
use App\Models\Store;
use App\Models\Product as ProductModel;
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

    public function mount(ProductModel $product) {
        // $this->product = $product;

        $this->product = ProductModel::find(3);

        $this->categories = Category::all();
        $this->stores = Store::all();
        $this->location = "";
    }

    public function edit(ProductModel $product)
    {
        $this->product = $product;
        // $this->edit = true;

        return;
    }

    public function render()
    {
        return view('livewire.products.product-form');
    }

    public function updateProductLocation() {
        debug($this->product);
    }

    public function submit() 
    {
        $this->validate();
        $this->product->save();
        // Image validation
        // if (!$this->image) {
        //     $this->validate([
        //         "product.image" => ["required", 'image', "mimes:jpg,jpeg,png"]
        //     ]);
        // }
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
                "unique:product,name,".$this->product->id.",id",
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
            "product.price_old" => [
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
            "product.image" => [
                "required", 
                "image", 
                "mimes:jpg,jpeg,png"]
        ];
    }
}
