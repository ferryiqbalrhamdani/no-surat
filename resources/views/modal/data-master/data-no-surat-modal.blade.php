<div wire:ignore.self class="modal fade" id="tambahTahun" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='saveTahun'>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="nama_tahun" class="form-label">Nama Tahun</label>
                            <input readonly class="form-control @error('nama_tahun') is-invalid @enderror"
                                id="nama_tahun" wire:model.live='nama_tahun' type="text">
                            @error('nama_tahun')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->

                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='save'>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="namaPt">Nama PT</label>
                                <select class="form-control" wire:model.live='namaPt' id="namaPt">
                                    @foreach ($dataPT as $t)
                                    <option value="{{$t->slug}}">{{ $t->slug }}</option>

                                    @endforeach
                                </select>
                            </div>
                            @error('nama_tahun')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->

                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">
                        <div class="" wire:loading='save'>Proses</div>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('data-no-surat')
<script>
    window.addEventListener('closeSaveTahun', event =>{
        $('#tambahTahun').modal('hide');
    });
    window.addEventListener('closeSave', event =>{
        $('#tambahData').modal('hide');
    });
    document.addEventListener('livewire:initialized', () =>{
        @this.on('save',(event) => {
            const data=event
            swal.fire({
                toast: true,
                position: "top-end",
                icon:data[0]['icon'],
                title:data[0]['title'],
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            })
    });
</script>
@endpush