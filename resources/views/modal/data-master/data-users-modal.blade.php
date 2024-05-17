<div wire:ignore.self class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='save'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" id="first_name" wire:model.live='first_name'
                                    class="form-control @error('first_name') is-invalid @enderror">
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" id="last_name" wire:model.live='last_name'
                                    class="form-control @error('last_name') is-invalid @enderror">
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="l"
                                            value="l" wire:model.live='jk'>
                                        <label class="form-check-label" for="l">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            wire:model.live='jk' id="p" value="p">
                                        <label class="form-check-label" for="p">
                                            Perempuan
                                        </label>
                                    </div>
                                    @error('jk')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="role_id">Role User</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror"
                                        wire:model.live='role_id' id="role_id">
                                        <option></option>
                                        @foreach ($roles as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="pt_id">PT</label>
                                    <select class="form-control @error('pt_id') is-invalid @enderror"
                                        wire:model.live='pt_id' id="pt_id">
                                        <option value=""></option>
                                        @foreach ($pt as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pt_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
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
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='closeSave'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='actionUbah'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" id="first_name" wire:model.live='first_name'
                                    class="form-control @error('first_name') is-invalid @enderror">
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" id="last_name" wire:model.live='last_name'
                                    class="form-control @error('last_name') is-invalid @enderror">
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="l"
                                            value="l" wire:model.live='jk'>
                                        <label class="form-check-label" for="l">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            wire:model.live='jk' id="p" value="p">
                                        <label class="form-check-label" for="p">
                                            Perempuan
                                        </label>
                                    </div>
                                    @error('jk')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="role_id">Role User</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror"
                                        wire:model.live='role_id' id="role_id">
                                        <option></option>
                                        @foreach ($roles as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="pt_id">PT</label>
                                    <select class="form-control @error('pt_id') is-invalid @enderror"
                                        wire:model.live='pt_id' id="pt_id">
                                        <option value=""></option>
                                        @foreach ($pt as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pt_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
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

<div wire:ignore.self class="modal fade" id="konfirmReset" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='closeSave'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='actionResetPasswordUser'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <p class="text-center">Apakah anda ingin reset password <b>{{$first_name}} {{ $last_name
                                        }}</b>?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='closeSave' class="btn btn-outline-dark"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Iya, reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('data-users')
<script>
    window.addEventListener('closeSave', event =>{
        $('#tambahData').modal('hide');
    });
    window.addEventListener('edit', event =>{
        $('#ubahData').modal('show');
    });
    window.addEventListener('closeEdit', event =>{
        $('#ubahData').modal('hide');
    });
    window.addEventListener('hapus', event =>{
        $('#hapusData').modal('show');
    });
    window.addEventListener('closeHapus', event =>{
        $('#hapusData').modal('hide');
    });
    
    window.addEventListener('openResetPassword', event =>{
        $('#konfirmReset').modal('show');
    });
    
    window.addEventListener('reset-password', event =>{
        $('#konfirmReset').modal('hide');
    });
    
    window.addEventListener('save', event =>{
        $('#liveToast').toast('show')
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