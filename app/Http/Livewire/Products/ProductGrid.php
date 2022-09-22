<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ProductGrid extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('new-product')
                ->caption('New Product')
                ->class('btn btn-primary')
                ->route("create_product", [])
                // ->emit('new-product', [])
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Product>
    */
    public function datasource(): Builder
    {
        return Product::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('category_id')
            ->addColumn('store_id')
            ->addColumn('type')
            ->addColumn('name')
            ->addColumn('quantity')
            ->addColumn('price')
            ->addColumn('old_price')
            ->addColumn('hot')
            ->addColumn('deal_of_the_day')
            ->addColumn('start_date_formatted', fn (Product $model) => Carbon::parse($model->start_date)->format('d/m/Y H:i:s'))
            ->addColumn('end_date_formatted', fn (Product $model) => Carbon::parse($model->end_date)->format('d/m/Y H:i:s'))
            ->addColumn('views')
            ->addColumn('status');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),

            Column::make('CATEGORY ID', 'category_id'),

            Column::make('STORE ID', 'store_id'),

            Column::make('TYPE', 'type'),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable(),

            Column::make('QUANTITY', 'quantity'),

            Column::make('PRICE', 'price'),

            Column::make('OLD PRICE', 'old_price'),

            Column::make('HOT', 'hot')
                ->toggleable(),

            Column::make('DEAL OF THE DAY', 'deal_of_the_day')
                ->toggleable(),

            Column::make('START DATE', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('END DATE', 'end_date_formatted', 'end_date')
                ->searchable()
                ->sortable(),

            Column::make('VIEWS', 'views'),

            Column::make('STATUS', 'status'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Product Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('product.edit', ['product' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('product.destroy', ['product' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Product Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($product) => $product->id === 1)
                ->hide(),
        ];
    }
    */
}
