<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class CategoryTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {
        return Category::get();
        // return collect([
        //     ['id' => 1, 'name' => 'Name 1', 'price' => 1.58, 'created_at' => now(),],
        //     ['id' => 2, 'name' => 'Name 2', 'price' => 1.68, 'created_at' => now(),],
        //     ['id' => 3, 'name' => 'Name 3', 'price' => 1.78, 'created_at' => now(),],
        //     ['id' => 4, 'name' => 'Name 4', 'price' => 1.88, 'created_at' => now(),],
        //     ['id' => 5, 'name' => 'Name 5', 'price' => 1.98, 'created_at' => now(),],
        // ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

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
            ->addColumn('parent_id')
            ->addColumn('category_icon')
            ->addColumn('category_color')
            ->addColumn('category_name')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
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
                ->searchable()
                ->sortable(),

            Column::make('Parent ID', 'parent_id')
                ->searchable()
                ->sortable(),

            Column::make('Icon', 'category_icon')
                ->searchable()
                ->makeInputText('category_icon')
                ->editOnClick(true)
                ->sortable(),

            Column::make('Color', 'category_color')
                ->sortable(),

            Column::make('Name', 'category_name')
                ->searchable()
                ->makeInputText('category_name')
                ->sortable(),

            Column::make('Created', 'created_at_formatted')
                ->makeInputDatePicker('created_at'),
        ];
    }
}
