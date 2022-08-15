<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class StoreGrid extends PowerGridComponent
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
    * @return Builder<\App\Models\Store>
    */
    public function datasource(): Builder
    {
        return Store::query()
            ->join('location', 'location.id', '=', 'store.location_id')
            // ->join('category', 'category.id', '=', 'store.category_id')
            ->select('store.*', 'location.name as location_name', 
            // 'category.name as category_name'
        );
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
            ->addColumn('image', function (Store $store) {
                return '<img src="/' . $store->image . '" width="80" height="40">';
            })
            ->addColumn('location_id')
            // ->addColumn('category_id')
            ->addColumn('name')
            ->addColumn('address', function(Store $store) {
                return Str::limit($store->address, 20, '...');
            })
            ->addColumn('link', function(Store $store) {
                return '<a href="' . $store->link . '" target="_blank"><i class="fa fa-link text-success"></i></a>';
            })
            ->addColumn('display')
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
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),

            Column::make('IMAGE', 'image'),

            Column::make('LOCATION ID', 'location_name')
                ->sortable()
                ->searchable(),

            // Column::make('CATEGORY ID', 'category_name'),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable(),

            Column::make('ADDRESS', 'address')
                ->sortable()
                ->searchable(),

            Column::make('LINK', 'link')
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center')
                ->sortable()
                ->searchable(),

            Column::make('DISPLAY', 'display')
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center')
                ->sortable()
                ->toggleable(),

            Column::make('STATUS', 'status')
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center')
                ->sortable()
                ->toggleable(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Store Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('btn btn-primary btn-sm w-100')
               ->target('_self')
               ->route('stores.edit', ['id' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('btn btn-danger btn-sm w-100')
               ->route('stores.delete', ['id' => 'id'])
               ->target('_self')
               ->method('delete')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Store Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($store) => $store->id === 1)
                ->hide(),
        ];
    }
    */

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        $store = Store::find($id);
        $store->{$field} = $value;
        $store->save();
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        $store = Store::find($id);
        $store->{$field} = $value;
        $store->save();
    }
}
