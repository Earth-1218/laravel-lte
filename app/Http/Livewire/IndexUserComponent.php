<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class IndexUserComponent extends Component
{
    use HasTable, HasLivewireAuth;

    public $dateRange = '';

    /** @var string */
    public $sortField = 'email';

    /** @var string */
    public $roleId = '';

    /** @var string */
    public $sortDirection = 'asc';

    /** @var string */
    public $search = '';

    /** @var int */
    public $perPage = 10;

    /** @var array */
    protected $queryString = [
        'perPage',
        'sortField',
        'sortDirection',
        'search',
        'roleId',
        'dateRange'
    ];

    /** @var array */
    protected $listeners = ['entity-deleted' => 'render', 'update-transaction-data' => 'updateTransactionData'];

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $query = User::with('role');

        if (!empty($this->dateRange)) {
            $date_parts = explode(" - ", $this->dateRange);
            $start_date = $date_parts[0] . ' 00:00:00'; // Start of the day
            $end_date = $date_parts[1] . ' 23:59:59'; // End of the day
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $users = $query->filter([
            'orderByField' => [$this->sortField, $this->sortDirection],
            'search' => $this->search,
            'roleId' => $this->roleId,
        ])->paginate($this->perPage);

        $roles = Role::orderBy('name')->get();

        return view('users.index', ['users' => $users, 'roles' => $roles])
            ->extends('layouts.app');
    }

    /**
     * Reset pagination back to page one if search query is changed.
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Reset pagination back to page one if roleId query is changed.
     *
     * @return void
     */
    public function updatedRoleId()
    {
        $this->resetPage();
    }

    /**
     * Update data when date range is changed.
     *
     * @param string $dateRange
     * @return void
     */
    public function updateTransactionData($dateRange)
    {
        $this->dateRange = $dateRange;
        $this->resetPage();
    }

    /**
     * Emit the update-data event to reload the table.
     *
     * @return void
     */
    public function reloadTable()
    {
        $this->emit('update-data');
    }
}
