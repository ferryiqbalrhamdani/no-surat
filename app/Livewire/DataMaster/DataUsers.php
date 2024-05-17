<?php

namespace App\Livewire\DataMaster;

use App\Models\ModelDataPT;
use App\Models\ModelRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DataUsers extends Component
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

    public $id_user;

    public $username;
    public $password;
    public $last_name;
    public $status;

    #[Rule('required')]
    public $first_name;
    #[Rule('required', as: 'jenis kelamin')]
    public $jk = 'l';
    #[Rule('required', as: 'role user')]
    public $role_id;
    #[Rule('required', as: 'pt')]
    public $pt_id;

    public $url;
    public $message = '';

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

        $username = User::generateUniqueUsername($this->first_name);

        $user = new User();
        $user->createUser($username, $this->first_name, $this->last_name, $this->jk, $this->role_id, $this->pt_id);

        $this->first_name = '';
        $this->last_name = '';
        $this->jk = '';
        $this->role_id = '';
        $this->pt_id = '';

        $this->message = 'Data berhasil ditambahkan.';


        $this->dispatch('closeSave');
        $this->dispatch('save', [
            'title' => 'Data berhasil ditambahkan.',
            'icon' => 'success',
        ]);
    }

    public function closeSave()
    {
        $this->resetValidation();
        $this->reset([
            'id_user',
            'first_name',
            'last_name',
            'jk',
            'role_id',
            'pt_id',
            'message'
        ]);
    }

    public function resetPasswordUser($id)
    {
        $user = User::find($id);
        $this->id_user = $id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;


        $this->dispatch('openResetPassword');
    }


    public function actionResetPasswordUser()
    {
        User::where('id', $this->id_user)->update([
            'password' => Hash::make('user123'),
            'is_password' => false,
        ]);
        $this->id_user = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->message = 'Password berhasil direset.';

        $this->dispatch('reset-password');
        $this->dispatch('save', [
            'title' => 'Password berhasil direset.',
            'icon' => 'success',
        ]);
    }

    public function actionUbah()
    {
        $this->validate();
        User::where('id', $this->id_user)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'jk' => $this->jk,
            'role_id' => $this->role_id,
            'pt_id' => $this->pt_id,
        ]);

        $this->id_user = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->jk = '';
        $this->role_id = '';
        $this->pt_id = '';

        $this->message = 'Data berhasil diubah.';

        $this->dispatch('closeEdit');
        $this->dispatch('save', [
            'title' => 'Data berhasil diubah.',
            'icon' => 'success',
        ]);
    }

    public function ubah($id)
    {
        $user = User::find($id);
        $this->id_user = $id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->jk = $user->jk;
        $this->role_id = $user->role_id;
        $this->pt_id = $user->pt_id;


        $this->dispatch('edit');
    }

    #[Title('Data Users')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.data-master.data-users', [
            'users' => User::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->orWhere('jk', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
            'roles' => ModelRole::all(),
            'pt' => ModelDataPT::all(),
        ]);
    }
}
