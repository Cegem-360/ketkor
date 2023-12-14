<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserAdminTable extends PowerGridComponent
{
    use WithExport;
    public string $sortField = 'users.id';
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
    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot(__('Bulk delete') . __('(<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)'))
                ->class('cursor-pointer block bg-white-200 text-gray-700 ')
                ->dispatch('bulkDeleteUser', []),
        ];
    }
    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'bulkDeleteUser',
            ]
        );
    }
    public function bulkDeleteUser()
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }
        foreach (User::find($this->checkboxValues) as $user) {
            $user->delete();
        }
        $this->redirect(route('users.index'), true);

    }
    public function datasource(): Builder
    {
        return User::query()->join('organizations', function ($organizations) {
            $organizations->on('users.organization_id', '=', 'organizations.id');
        });
    }

    public function relationSearch(): array
    {
        return ['organization' => ['name']];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('organization_name', fn(User $model) => $model->organization->name);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(__('Name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make(__('Organization name'), 'organization_name')
                ->sortable()
                ->searchable(),

            Column::action(__('Action'))
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('organization_name', 'organizations.name')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->redirect(route('users.show', $rowId), true);
    }
    #[\Livewire\Attributes\On('delete')]
    public function delete(User $rowId): void
    {
        $rowId->delete();
        session()->flash('message', __('User successfully deleted.'));
        $this->redirect(route('users.index'), true);
    }

    public function actions(User $row): array
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
