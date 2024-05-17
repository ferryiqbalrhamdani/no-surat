<?php

namespace App\Livewire\DataMaster;

use App\Models\ModelDataPT;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DataPt extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    #[Url()]
    public $sortField = 'created_at';
    #[Url()]
    public $sortDirection = 'desc';

    #[Url()]
    public $search = '';

    public $id_pt;

    #[Rule('required', as: 'nama pt')]
    public $name;
    #[Rule('required')]
    public $slug;

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

        $model = new ModelDataPT();
        $model->saveData($this->name, $this->slug);

        $this->name = '';
        $this->slug = '';

        $this->dispatch('closeSave');
        $this->dispatch('save', [
            'title' => 'Data berhasil ditambah.',
            'icon' => 'success',
        ]);
    }

    public function closeSave()
    {
        $this->id_pt = '';
        $this->name = '';
        $this->slug = '';
        $this->resetValidation();
    }

    public function ubah($id)
    {
        $this->id_pt = $id;
        $data = ModelDataPT::find($this->id_pt);
        $this->name = $data->name;
        $this->slug = $data->slug;

        $this->dispatch('edit');
    }

    public function actionUbah()
    {
        $this->validate();

        $model = new ModelDataPT();
        $result = $model->updateData($this->id_pt, $this->name, $this->slug);

        $this->id_pt = '';
        $this->name = '';
        $this->slug = '';

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
        $this->id_pt = $id;
        $data = ModelDataPT::find($this->id_pt);
        $this->name = $data->name;

        $this->dispatch('hapus');
    }

    public function actionHapus()
    {
        $model = new ModelDataPT();
        $model->deleteData($this->id_pt);

        $this->id_pt = '';
        $this->name = '';

        $this->dispatch('closeHapus');
        $this->dispatch('save', [
            'title' => 'Data berhasil dihapus.',
            'icon' => 'success',
        ]);
    }

    #[Title('Data PT')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.data-master.data-pt', [
            'dataPT' => ModelDataPT::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
