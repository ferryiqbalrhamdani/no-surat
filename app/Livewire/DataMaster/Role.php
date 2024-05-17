<?php

namespace App\Livewire\DataMaster;

use App\Models\ModelRole;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;


class Role extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $id_role;

    #[Url()]
    public $search = '';

    #[Rule('required', as: 'nama')]
    public $name;

    public $url;

    public function mount()
    {
        $this->url = Request::path();
    }

    public function sortBy($sortField)
    {
        if ($this->sortField === $sortField) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $sortField;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function save()
    {
        $this->validate();

        $model = new ModelRole();
        $model->saveData($this->name);

        $this->name = '';

        $this->dispatch('closeSave');
        $this->dispatch('save', [
            'title' => 'Data berhasil ditambah.',
            'icon' => 'success',
        ]);
    }

    public function closeSave()
    {
        $this->name = '';
        $this->resetValidation();
    }

    public function ubah($id)
    {
        $this->id_role = $id;
        $data = ModelRole::find($this->id_role);
        $this->name = $data->name;

        $this->dispatch('edit');
    }

    public function actionUbah()
    {
        $this->validate();

        $model = new ModelRole();
        $result = $model->updateData($this->id_role, $this->name);

        $this->id_role = '';
        $this->name = '';

        if ($result) {
            $this->dispatch('closeUbah');
            $this->dispatch('save', [
                'title' => 'Data berhasil diubah.',
                'icon' => 'success',
            ]);
        } else {
            $this->dispatch('closeUbah');
            $this->dispatch('save', [
                'title' => 'Data tidak ditemukan.',
                'icon' => 'error',
            ]);
        }
    }

    public function hapus($id)
    {
        $this->id_role = $id;
        $data = ModelRole::find($this->id_role);
        $this->name = $data->name;

        $this->dispatch('hapus');
    }

    public function actionHapus()
    {
        $model = new ModelRole();
        $model->deleteData($this->id_role);

        $this->id_role = '';
        $this->name = '';

        $this->dispatch('closeHapus');
        $this->dispatch('save', [
            'title' => 'Data berhasil dihapus.',
            'icon' => 'success',
        ]);
    }

    #[Title('Role')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.data-master.role', [
            'role' => ModelRole::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
