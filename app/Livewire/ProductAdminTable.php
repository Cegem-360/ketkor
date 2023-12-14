<?php

namespace App\Livewire;

use App\Models\Tool;
use App\Models\Product;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ProductAdminTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->queues('6')
                ->onConnection('database')
            ,
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Product::with([
            'partials' => function ($query) {
                $query->latest()->limit(1);
            },
            'tool'
        ]);
    }
    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot(__('Bulk delete') . __('(<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)'))
                ->class('cursor-pointer block bg-white-200 text-gray-700 ')
                ->dispatch('bulkDeleteProduct', []),
        ];
    }
    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'bulkDeleteProduct',
            ]
        );
    }
    public function bulkDeleteProduct()
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }
        foreach (Product::find($this->checkboxValues) as $product) {
            $product->delete();
        }
        $this->redirect(route('products.index'), true);

    }
    public function relationSearch(): array
    {
        return ['tool' => ['name']];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('owner_name')
            ->addColumn('installer_name')
            ->addColumn('city')
            ->addColumn('street')
            ->addColumn('zip')
            ->addColumn('purchase_place')
            ->addColumn('serial_number')
            ->addColumn('purchase_date_formatted', fn(Product $model) => Carbon::parse($model->purchase_date)->format('Y-m-d'))
            ->addColumn('installation_date_formatted', fn(Product $model) => Carbon::parse($model->installation_date)->format('Y-m-d'))
            ->addColumn('warrantee_date_formatted', fn(Product $model) => Carbon::parse($model->warrantee_date)->format('Y-m-d'))
            ->addColumn('tool_name', fn(Product $model) => $model->tool->name);

    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Owner name'), 'owner_name')
                ->sortable()
                ->searchable(),

            Column::make(__('Installer name'), 'installer_name')
                ->sortable()
                ->searchable(),

            Column::make(__('City'), 'city')
                ->sortable()
                ->searchable(),

            Column::make(__('Street'), 'street')
                ->sortable()
                ->searchable(),

            Column::make(__('Zip'), 'zip')
                ->sortable()
                ->searchable(),

            Column::make(__('Purchase place'), 'purchase_place')
                ->sortable()
                ->searchable(),

            Column::make(__('Serial number'), 'serial_number')
                ->sortable()
                ->searchable(),

            Column::make(__('Purchase date'), 'purchase_date_formatted', 'purchase_date')
                ->sortable(),

            Column::make(__('Installation date'), 'installation_date_formatted', 'installation_date')
                ->sortable(),

            Column::make(__('Warrantee date'), 'warrantee_date_formatted', 'warrantee_date')
                ->sortable(),

            Column::make(__('Tool name'), 'tool_name')
                ->sortable()
                ->searchable(),

            Column::action(__('Actions'))
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('owner_name')->operators(['contains']),
            Filter::inputText('installer_name')->operators(['contains']),
            Filter::inputText('city')->operators(['contains']),
            Filter::inputText('street')->operators(['contains']),
            Filter::inputText('zip')->operators(['contains']),
            Filter::inputText('purchase_place')->operators(['contains']),
            Filter::inputText('serial_number')->operators(['contains']),
            Filter::datepicker('purchase_date'),
            Filter::datepicker('installation_date'),
            Filter::datepicker('warrantee_date'),
            Filter::multiSelect('tool_name', 'tool_id')
                ->dataSource(Tool::all())
                ->optionValue('id')
                ->optionLabel('name'),
        ];
    }

    #[On('edit')]
    public function edit(Product $rowId): void
    {
        $this->redirect(route('products.edit', $rowId), true);
    }

    #[On('delete')]
    public function delete(Product $rowId): void
    {
        $rowId->delete();
        session()->flash('message', __('Product successfully deleted.'));
        $this->redirect(route('products.index'), true);
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot(__('Edit: ') . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot(__('delete: ') . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }
}
