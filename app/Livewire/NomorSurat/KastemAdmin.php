<?php

namespace App\Livewire\NomorSurat;

use App\Models\ModelArsipNoSurat;
use App\Models\ModelDataPT;
use App\Models\ModelNoSurat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class KastemAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $sortField = 'nomor_surat';
    public $sortDirection = 'asc';

    public $id_action;
    public $id, $nomor_surat;

    #[Url()]
    public $pt_slug = '';

    #[Url()]
    public $activeTab = '';

    #[Rule('required')]
    public $tgl_surat;
    #[Rule('required')]
    public $pic;

    public $daftarNoSurat = [];
    public $nomorSurat = [];


    #[Url()]
    public $search = '';

    #[Rule('required')]
    public $keterangan;

    #[Rule('required')]
    public $keterangan_reject;

    public $nomor_surat_action,  $status, $file, $pt, $dataArsip;

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

    public function pilih($id)
    {
        $this->id_action = $id;
        $data = ModelNoSurat::find($id);

        $this->nomor_surat_action = $data->nomor_surat;
        $this->pic = $data->id_user;
        $this->status = $data->status;
        $this->file = $data->file;
        $this->keterangan = $data->keterangan;

        $this->dispatch('show-pilih');
    }

    public function pakai()
    {
        $this->validate(
            [
                'tgl_surat' => 'required',
                'pic' => 'required',
                'keterangan' => 'required',
            ]
        );

        // dd($this->validate(), $this->id_action,);


        ModelNoSurat::generateNomorSuratAdmin($this->id_action, $this->tgl_surat, $this->pic, $this->keterangan);


        $this->dispatch('closePilih');
        $this->dispatch('save', [
            'title' => 'Perubahan berhasil disimpan',
            'icon' => 'success',
        ]);
    }

    public function close()
    {
        $this->resetValidation();
        $this->reset(['tgl_surat', 'pic', 'keterangan', 'keterangan_reject']);
    }

    public function editData($id)
    {
        $this->id_action = $id;
        $data = ModelNoSurat::find($id);
        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = Carbon::parse($data->tgl_surat)->format('Y-m-d');
        $this->pic = $data->id_user;
        $this->status = $data->status;
        $this->file = $data->file;
        $this->keterangan = $data->keterangan;

        $this->dispatch('showEdit');
    }

    public function updateData()
    {
        $this->validate([
            'tgl_surat' => 'required',
            'pic' => 'required',
            'keterangan' => 'required',
        ]);

        $data = ModelNoSurat::find($this->id_action);
        $file = $data->file;
        if ($this->file) {
            if ($file != NULL) {
                Storage::delete($data->file);
            }
            $file = $this->file->store('public/files');
        } else {
            $file = $data->file;
        }

        ModelNoSurat::where('id', $this->id_action)->update([
            'tgl_surat' => $this->tgl_surat,
            'id_user' => $this->pic,
            'status' => $this->status,
            'file' => $file,
            'keterangan' => $this->keterangan,
        ]);

        $this->dispatch('closeEdit');
        $this->dispatch('save', [
            'title' => 'Perubahan berhasil disimpan',
            'icon' => 'success',
        ]);
        // dd('masuk pak eko');
    }

    public function reject($id)
    {

        $this->id_action = $id;
        $data = ModelNoSurat::find($this->id_action);
        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = $data->tgl_surat;
        $this->file = $data->file;
        $this->pic = $data->user->first_name . ' ' . $data->user->last_name;

        $this->dispatch('showReject');
    }

    public function rejectData()
    {
        $this->validateOnly('keterangan_reject');

        ModelArsipNoSurat::rejectAndArchive($this->id_action, $this->pic, $this->tgl_surat, $this->keterangan_reject, $this->file, $this->nomor_surat_action);

        $this->reset('id_action', 'pic', 'tgl_surat', 'keterangan_reject', 'file', 'nomor_surat_action');
        $this->dispatch('closeReject');
        $this->dispatch('save', [
            'title' => 'Perubahan berhasil disimpan',
            'icon' => 'success',
        ]);
    }

    public function gunakan()
    {
        $this->nomor_surat_action = $this->nomor_surat;

        $this->dispatch('show-pilih');
    }

    public function detail($id)
    {

        $this->id_action = $id;
        $data = ModelNoSurat::find($this->id_action);

        $this->nomorSurat = $data;
        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = Carbon::parse($data->tgl_surat)->isoFormat('D MMMM Y');
        $this->pic = $data->user->first_name;
        $this->status = $data->status;
        $this->keterangan = $data->keterangan;
        $this->file = $data->file;
        $this->dataArsip = $data->arsipNoSurat->count();



        // dd($data->arsipNoSurat);

        $this->dispatch('show-detail');
    }

    public function closeDetail()
    {
        $this->id_action = '';

        $this->nomorSurat = '';
        $this->nomor_surat_action = '';
        $this->tgl_surat = '';
        $this->pic = '';
        $this->status = '';
        $this->keterangan = '';
    }

    #[Title('Kastem')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.nomor-surat.kastem-admin', [
            'dataPT' => ModelDataPT::where('slug', '!=', '-')->orderBy('slug', 'asc')->get(),
            'noSurat' => ModelNoSurat::where('pt_slug', 'like', '%' . $this->pt_slug . '%')
                ->where('status', 'like', '%' . $this->activeTab . '%')
                ->where('nomor_surat', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
            'users' => User::orderBy('first_name', 'asc')->get(),
        ]);
    }
}
