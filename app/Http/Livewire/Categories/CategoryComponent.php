<?php

namespace App\Http\Livewire\Categories;

use App\Http\Livewire\WithToaster;
use App\Models\Category as CategoryModel;
use Livewire\Component;

class CategoryComponent extends Component
{
    use WithToaster;

    public $category;
    public $parents;
    
    public $edit = false;
    public $success = null;

    protected $listeners = [
        "edit" => "edit",
        "delete" => "delete",
        "refreshComponent" => '$refresh'
    ];

    public function mount(CategoryModel $category)
    {
        $this->category = $category;
        $this->category->parent_id = 0;
        $this->category->color = "#000000";
        $this->parents = CategoryModel::whereColumn("id", "parent_id")->get();
        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }

    public function submit() 
    {
        $this->validate();
        $updated = $this->category->id > 0;

        $this->category->save();

        if ($this->category->parent_id == 0) {
            $this->category->parent_id = $this->category->id;
            $this->category->save();
        }

        $this->alert("success", "Success", "Category successfully ".($updated ? "updated" : "added"));

        $this->refreshAll();
    }

    public function edit(CategoryModel $category) 
    {
        $this->edit = true;
        $this->category = $category;
    }

    public function delete(CategoryModel $category) 
    {
        if ($category->children()->count() > 1) {
            $this->alert("error", "Error", "This category is currently in use and cannot be deleted");
            return;
        }

        $category->delete();
        $this->alert("success", "Success", "Category deleted");

        $this->refreshAll();

        return;
    }

    public function cancel() 
    {
        $this->refreshAll();
    }

    public function refreshAll() 
    {
        $this->mount(new CategoryModel());        
        $this->emit('refreshComponent');
        $this->emit('pg:eventRefresh-default');
    }

    public function rules() {
        return [
            "category.name" => [
                "required",
                "unique:category,name,".$this->category->id.",id,deleted_at,NULL",
                "min:3",
                "max:125"
            ],
            "category.parent_id" => [
                "numeric"
            ],
            "category.color" => [
                "required",
                "regex:/^#[a-zA-Z0-9]{6}/"
            ],
            "category.icon" => [
                "nullable"
            ]
        ];
    }

    public function messages() {
        return [
            "category.name.required" => "You must enter a category name",
            "category.name.unique" => "Category already exists",
            "category.name.max" => "Category name to long. Maximum 125 characters allowed",
            "category.name.min" => "Category name must be at least 3 characters long",
        ];
    }
}
