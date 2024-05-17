<?php

namespace App\Livewire\NomorSurat;

use App\Models\ModelArsipNoSurat;
use App\Models\ModelDataPT;
use App\Models\ModelNoSurat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class HariIni extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $id_action;
    public $id, $nomor_surat;
    public $nomorSurat, $status;


    #[Url()]
    public $pt = 'HSB';
    #[Url()]
    public $pt_slug = '';

    public $activeTab = '';

    #[Url()]
    public $search = '';

    #[Rule('required')]
    public $keterangan;


    public $url, $nomor_surat_action, $tgl_surat, $pic, $file;

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

    public function gunakan($id)
    {
        $this->id_action = $id;

        $this->dispatch('show-confirm-gunakan');
    }

    public function pakai()
    {
        $this->validate();

        $data = ModelNoSurat::where('id', $this->id_action)->first();

        if ($data->status == 0 || $data->status == 2) {

            ModelNoSurat::generateAndUpdateNomorSurat($this->id_action, $this->nomor_surat, $this->keterangan);

            $this->id_action = '';
            $this->activeTab = Auth::user()->id;
            $this->keterangan = '';


            $this->dispatch('closePakai');
            $this->dispatch('save', [
                'title' => 'Nomor surat berhasil di pakai',
                'icon' => 'success',
            ]);
        } else {
            $this->dispatch('save', [
                'title' => 'Nomor surat sudah digunakan',
                'icon' => 'error',
            ]);
        }
    }

    public function reject($id)
    {
        $this->id = $id;
        $data = ModelNoSurat::find($this->id);
        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = $data->tgl_surat;
        $this->pic = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $this->file = $data->file;



        $this->dispatch('show-confirm-reject');
    }

    public function actionReject()
    {
        $this->validate();


        // Panggil metode statis untuk mengupdate status pada ModelNoSurat dan membuat entri baru pada 

        ModelArsipNoSurat::rejectAndArchive($this->id, $this->pic, $this->tgl_surat, $this->keterangan, $this->file, $this->nomor_surat_action);

        $this->reset('id', 'pic', 'tgl_surat', 'keterangan');

        $this->dispatch('closeReject');

        $this->dispatch('save', [
            'title' => 'Nomor surat berhasila di reject',
            'icon' => 'success',
        ]);
    }

    public function detail($id)
    {

        $this->id_action = $id;
        $data = ModelNoSurat::find($this->id_action);

        $this->nomorSurat = $data;
        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = $data->tgl_surat;
        $this->pic = $data->user->first_name;
        $this->status = $data->status;
        $this->keterangan = $data->keterangan;


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

    public function edit($id)
    {

        $this->id_action = $id;
        $data = ModelNoSurat::find($this->id_action);
        $this->nomor_surat = $data->nomor_surat;
        $this->tgl_surat = Carbon::parse($data->tgl_surat)->format('d-m-Y'); // $data->tgl_surat;
        $this->keterangan = $data->keterangan;
        $this->pic = $data->user->first_name;
        $this->status = $data->status;



        $this->dispatch('show-edit');
    }

    #[Title('Hari Ini')]
    #[Layout('layouts.app')]
    public function render()
    {
        $data = ModelNoSurat::where('pt_slug', 'like', '%' . $this->pt . '%')
            ->where('tahun', Carbon::now()->year)
            ->where('status', 0)
            ->orderBy('id', 'asc')
            ->first();

        if ($data) {
            $this->id_action =  $data->id;
        }

        if ($data) {
            $parts = explode("/", $data->nomor_surat);

            // Konversi format bulan
            $bulan = Carbon::now()->format('n');

            // Konversi bulan menjadi Romawi
            $bulanRomawi = ModelNoSurat::convertToRoman($bulan);

            // Rekonstruksi nomor surat
            $nomor_surat = $parts[0] . '/' . $parts[1] . '/' . $bulanRomawi . '/' . $parts[3];
            $this->nomor_surat = $nomor_surat;
        } else {
            $this->nomor_surat = 'Tidak ada nomor surat';
        }


        return view('livewire.nomor-surat.hari-ini', [
            'dataPT' => ModelDataPT::orderBy('slug', 'asc')->get(),
            'noSurat' => ModelNoSurat::where('pt_slug', 'like', '%' . $this->pt_slug . '%')
                ->whereYear('tgl_surat', Carbon::now()->year)
                ->where('status', '>', 0)
                ->where('nomor_surat', 'like', '%' . $this->search . '%')
                ->where('id_user', 'like', '%' . $this->activeTab . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),

        ]);
    }

    public function updated()
    {
        $this->render();
    }
}
