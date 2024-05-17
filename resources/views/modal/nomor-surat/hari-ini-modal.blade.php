<div wire:ignore.self class="modal fade" id="konfirmGuanakan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='pakai'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            <p>Apakah anda yakin ingin menggunakan nomor surat <b>{{$nomor_surat}}</b> pada
                                tanggal
                                <b>{{ \Carbon\Carbon::now()->isoFormat('DD, MMMM YYYY')}}</b>?
                            </p>
                            <div class="row row-sm mg-t-20">
                                <div class="col-lg">
                                    <input placeholder="Tuliskan keterangan surat"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        wire:model.live='keterangan' id="keterangan">
                                    @error('keterangan')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div><!-- col -->
                            </div><!-- row -->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-az-primary">Ya, Gunakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="konfirmReject" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent='actionReject'>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            <p>Apakah anda yakin tidak ingin menggunakan nomor surat <b>{{$nomor_surat_action}}</b> pada
                                tanggal
                                <b>{{ \Carbon\Carbon::parse($tgl_surat)->isoFormat('DD, MMMM YYYY')}}</b>?
                            </p>
                            <div class="row row-sm mg-t-20">
                                <div class="col-lg">
                                    <input placeholder="Tuliskan keterangan surat"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        wire:model.live='keterangan' id="keterangan">
                                    @error('keterangan')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div><!-- col -->
                            </div><!-- row -->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Ya, Kirim</button>
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
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $tgl_surat }}</td>
                                    <td>{{ $pic }}</td>
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
                                    <td colspan="3" class="text-center">Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        @if($keterangan)
                                        {{ $keterangan }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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


                        <br>
                        {{-- {{$nomorSurat->arsipNoSurat}} --}}
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

<div wire:ignore.self class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-center"><b>{{ $nomor_surat }}</b></h5>
                        <hr>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>PIC</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $tgl_surat }}</td>
                                    <td>{{ $pic }}</td>
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

                        </table>

                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Unggah File PDF</label>
                                        <input type="file" class="form-control-file" wire:model.live='file'
                                            id="exampleFormControlFile1">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" wire:model.live='keterangan' class="form-control">
                                </div>
                            </div>
                        </form>

                        {{-- {{$nomorSurat->arsipNoSurat}} --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-az-primary" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('hari-ini')
<script>
    window.addEventListener('show-confirm-gunakan', event =>{
        $('#konfirmGuanakan').modal('show');
    });
    window.addEventListener('closePakai', event =>{
        $('#konfirmGuanakan').modal('hide');
    });
    window.addEventListener('show-confirm-reject', event =>{
        $('#konfirmReject').modal('show');
    });
    window.addEventListener('closeReject', event =>{
        $('#konfirmReject').modal('hide');
    });
    window.addEventListener('show-detail', event =>{
        $('#detail').modal('show');
    });
    window.addEventListener('show-edit', event =>{
        $('#edit').modal('show');
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

    $('.fc-datepicker').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true
        });
</script>
@endpush