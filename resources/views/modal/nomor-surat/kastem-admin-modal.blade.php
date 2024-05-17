<div wire:ignore.self class="modal fade" id="pilih" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pilih Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='close'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='pakai'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <h3>{{$nomor_surat_action}}</h3>
                            <hr>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" wire:model.live='tgl_surat'
                                class="form-control @error('tgl_surat') is-invalid @enderror">
                            @error('tgl_surat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <select wire:model.live='pic' name="pic" id="pic"
                                class="form-control @error('pic') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($users as $u)
                                <option value="{{$u->id}}">{{$u->first_name}} {{$u->last_name}}</option>
                                @endforeach

                            </select>
                            @error('pic')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="keterangan">Pesan</label>
                                <textarea wire:model.blur='keterangan'
                                    class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    rows="3"></textarea>
                                @error('keterangan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='close' class="btn btn-secondary"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Ya, Gunakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='close'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='updateData'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <h3>{{$nomor_surat_action}}</h3>
                            <hr>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" wire:model.live='tgl_surat'
                                class="form-control @error('tgl_surat') is-invalid @enderror">
                            @error('tgl_surat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <select wire:model.live='pic' name="pic" id="pic"
                                class="form-control @error('pic') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($users as $u)
                                <option value="{{$u->id}}" @if($u->id == $pic) selected @endif>{{$u->first_name}}
                                    {{$u->last_name}}</option>
                                @endforeach

                            </select>
                            @error('pic')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="file">Upload File</label>
                                <input wire:model.live='file' type="file" class="form-control-file" id="file">
                            </div>
                            @error('file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="keterangan">Pesan</label>
                                <textarea wire:model.blur='keterangan'
                                    class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    rows="3"></textarea>
                                @error('keterangan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='close' class="btn btn-secondary"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="reject" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reject Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='close'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='rejectData'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <p>Apakah anda yakin tidak ingin menggunakan nomor surat <b>{{$nomor_surat_action}}</b>
                                dengan PIC
                                <b>{{ $pic }}</b>?
                            </p>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="keterangan_reject">Pesan</label>
                                <textarea wire:model.blur='keterangan_reject'
                                    class="form-control @error('keterangan_reject') is-invalid @enderror"
                                    id="keterangan_reject" rows="3"></textarea>
                                @error('keterangan_reject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='close' class="btn btn-secondary"
                        data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="detail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-center"><b>{{ $nomor_surat_action }}</b></h5>
                        <hr>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>PIC</td>
                                    <td>File</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $tgl_surat }}</td>
                                    <td>{{ $pic }}</td>
                                    <td>
                                        @if($file== NULL)
                                        -
                                        @else
                                        <button class="btn btn-sm btn-info" wire:click='uploadFile({{$ns->id}})'
                                            data-toggle="tooltip" data-placement="top" title="download file">
                                            <i class="fas fa-file-upload"></i>
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($status == 0)
                                        <span class="badge badge-warning">tersedia</span>
                                        @elseif($status == 1)
                                        <span class="badge badge-success">terpakai</span>
                                        @elseif($status == 2)
                                        <span class="badge badge-danger">tidak terpakai</span>
                                        @elseif($status == 3)
                                        <span class="badge badge-secondary">backdate</span>

                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <td colspan="4" class="text-center">Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        @if($keterangan)
                                        {{ $keterangan }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @if($dataArsip > 0)
                        <div class="text-center">
                            <p>History</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>PIC</th>
                                        <th>File</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(empty($nomorSurat->arsipNoSurat))
                                    <tr>
                                        <td colspan="5">Tidak ada data.</td>
                                    </tr>
                                    @else
                                    @foreach($nomorSurat->arsipNoSurat as $data)
                                    <tr>
                                        <td>{{ $data->nomor_surat }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->tgl_surat)->isoFormat('DD, MMMM YYYY') }}
                                        </td>
                                        <td>{{ $data->pic }}</td>
                                        <td class="text-center">
                                            @if ($data->file)
                                            <button class="btn btn-az-primary">file</button>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $data->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @endif


                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click='closeDetail' type="button" class="btn btn-secondary form-control"
                    data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

@push('kastem-admin')
<script>
    window.addEventListener('show-pilih', event =>{
        $('#pilih').modal('show');
    });
    window.addEventListener('closePilih', event =>{
        $('#pilih').modal('hide');
    });

    window.addEventListener('showEdit', event =>{
        $('#edit').modal('show');
    });
    window.addEventListener('closeEdit', event =>{
        $('#edit').modal('hide');
    });
    window.addEventListener('showReject', event =>{
        $('#reject').modal('show');
    });
    window.addEventListener('closeReject', event =>{
        $('#reject').modal('hide');
    });
    window.addEventListener('show-detail', event =>{
        $('#detail').modal('show');
    });
    
    document.addEventListener('livewire:initialized', () =>{
        @this.on('save',(event) => {
            const data=event
            swal.fire({
                icon:data[0]['icon'],
                title:data[0]['title'],
                timer: 5000,
                timerProgressBar: true,
            })
            })
    });

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush