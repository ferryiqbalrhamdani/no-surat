<!-- Modal -->
<div wire:ignore.self class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data PT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='save'>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="name" class="form-label">Nama PT</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name"
                                wire:model.live='name' type="text">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="slug" class="form-label">Slug</label>
                            <input class="form-control @error('slug') is-invalid @enderror" id="slug"
                                wire:model.live='slug' type="text">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->
                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='closeSave' class="btn btn-outline-dark"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="ubahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Data PT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='actionUbah'>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="name" class="form-label">Nama PT</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name"
                                wire:model.live='name' type="text">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="slug" class="form-label">Slug</label>
                            <input class="form-control @error('slug') is-invalid @enderror" id="slug"
                                wire:model.live='slug' type="text">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- col -->
                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='closeSave' class="btn btn-outline-dark"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="hapusData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='actionHapus'>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg text-center">
                            <p>Apakah anda yakin ingin menghapus data <b>{{ $name }}</b>?</p>
                        </div><!-- col -->

                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='closeSave' class="btn btn-outline-dark"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('data-pt')
<script>
    window.addEventListener('closeSave', event =>{
        $('#tambahData').modal('hide');
    });
    window.addEventListener('edit', event =>{
        $('#ubahData').modal('show');
    });
    window.addEventListener('closeUbah', event =>{
        $('#ubahData').modal('hide');
    });
    window.addEventListener('hapus', event =>{
        $('#hapusData').modal('show');
    });
    window.addEventListener('closeHapus', event =>{
        $('#hapusData').modal('hide');
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