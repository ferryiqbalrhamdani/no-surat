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
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Kastem extends Component
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
    #[Rule('before:today', message: "Tidak boleh sama atau melebihi dengan tanggal hari ini")]
    public $tanggal;
    #[Rule('required', as: "PT")]
    public $slug;

    public $daftarNoSurat = [];
    public $nomorSurat = [];

    public $dataArsip;




    #[Url()]
    public $search = '';

    public $generate = '';

    #[Rule('required')]
    public $keterangan;

    public $nomor_surat_action, $tgl_surat, $status, $pic, $file;

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

    public function cari()
    {
        // Validasi input
        $this->validate([
            'tanggal' => 'required|before:today',
            'slug' => 'required',
        ]);
        try {

            // Cari nomor surat
            $data = ModelNoSurat::cariNomorSurat($this->slug, $this->tanggal);

            // Set properti kelas
            $this->id_action = $data['id'];
            $this->nomor_surat_action = $data['no_surat'];
            $this->status = $data['status'];

            // Buat array daftarNoSurat
            $this->daftarNoSurat = [
                'nomor_surat' => $data['no_surat'],
                'status' => $data['status'],
                'tgl_surat' => $this->tanggal,
            ];

            // Return daftarNoSurat
            return $this->daftarNoSurat;
        } catch (\Exception $e) {
            $this->id_action = '';
            $this->nomor_surat_action = '';
            $this->status = '';
            $this->daftarNoSurat = [];
            // Tangani kesalahan lainnya
            return $this->dispatch('save', [
                'title' => 'Tidak ada nomor surat yang ditemukan',
                'icon' => 'error',
            ]);
        }
    }

    public function pakai()
    {
        $this->dispatch('show-confirm-pakai');
    }

    public function actionPakai()
    {
        $this->validate();
        $data = ModelNoSurat::find($this->id_action);
        $pic = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $tgl_surat = $data->tgl_surat;
        $file = $data->file;
        $nomor_surat = $this->nomor_surat_action;

        ModelNoSurat::updateNoSurat($this->id_action, $nomor_surat, $this->tanggal, $this->keterangan, $this->status, $this->slug);

        if ($this->status == 2) {
            ModelArsipNoSurat::rejectAndArchive($this->id_action, $pic, $tgl_surat, $this->keterangan, $file, $nomor_surat);
        }

        $this->id_action = '';
        $this->nomor_surat_action = '';
        $this->activeTab = 1;
        $this->keterangan = '';
        $this->tanggal = '';
        $this->slug = '';
        $this->daftarNoSurat = [];

        $this->sortField = 'updated_at';
        $this->sortDirection = 'desc';


        $this->dispatch('closePakai');
        $this->dispatch('save', [
            'title' => 'Nomor surat berhasil di pakai',
            'icon' => 'success',
        ]);
    }

    public function reject($id)
    {

        $this->id_action = $id;
        $data = ModelNoSurat::find($this->id_action);

        $this->nomor_surat_action = $data->nomor_surat;
        $this->tgl_surat = Carbon::parse($data->tgl_surat)->isoFormat('D MMMM Y');

        $this->dispatch('show-confirm-reject');
    }

    public function actionReject()
    {
        $this->validateOnly('keterangan');
        // dd('ok');

        $data = ModelNoSurat::find($this->id_action);
        $pic = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $tgl_surat = $data->tgl_surat;
        $file = $data->file;
        $nomor_surat = $this->nomor_surat_action;

        ModelNoSurat::where('id', $this->id_action)->update(['status' => 3]);

        ModelArsipNoSurat::rejectAndArchive($this->id_action, $pic, $tgl_surat, $this->keterangan, $file, $nomor_surat);

        $this->id_action = '';
        $this->nomor_surat_action = '';
        $this->tgl_surat = '';
        $this->keterangan = '';

        $this->dispatch('closeReject');
        $this->dispatch('save', [
            'title' => 'Perubahan berhasil disimpan',
            'icon' => 'success',
        ]);
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
        return view('livewire.nomor-surat.kastem', [
            'dataPT' => ModelDataPT::where('slug', '!=', '-')->orderBy('slug', 'asc')->get(),
            'noSurat' => ModelNoSurat::where('pt_slug', 'like', '%' . $this->pt_slug . '%')
                ->where('id_user', 'like', '%' . $this->generate . '%')
                ->whereYear('tgl_surat', Carbon::now()->year)
                ->where('status', '>', 0)
                ->where('status', 'like', '%' . $this->activeTab . '%')
                ->where('nomor_surat', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),

        ]);
    }
}
