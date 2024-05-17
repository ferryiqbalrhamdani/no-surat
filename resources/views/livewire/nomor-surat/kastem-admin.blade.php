<div>
    @include('modal.nomor-surat.kastem-admin-modal')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('layouts.sidebar-no-surat')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Nomor Surat</span>
                    <span>Kastem</span>
                </div>
                <div class="az-content-label mg-b-5 mt-3">
                    <div class="mg-b-20">
                        <div class="d-flex justify-content-center">
                            <div class="row mb-3 bg-indigo rounded">
                                <div class="col">
                                    <button class="btn btn-indigo" wire:model="activeTab" @if($activeTab=='' ) disabled
                                        @endif wire:click="$set('activeTab', '')">Semua Nomor Surat</button>
                                    <button class="btn btn-indigo" wire:model="activeTab" wire:model="activeTab"
                                        @if($activeTab==1) disabled @endif wire:click="$set('activeTab', '1')">
                                        Terpakai
                                    </button>
                                    <button class="btn btn-indigo" wire:model="activeTab" wire:model="activeTab"
                                        @if($activeTab==2) disabled @endif wire:click="$set('activeTab', '2')">
                                        Tidak Terpakai
                                    </button>
                                    <button class="btn btn-indigo" wire:model="activeTab" wire:model="activeTab"
                                        @if($activeTab==3) disabled @endif wire:click="$set('activeTab', '3')">
                                        Backdate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="mb-3 mt-3">
                            Show <select class=" card-hover" aria-label="Small select example"
                                wire:model.live='perPage'>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                            </select> entries
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 text-center">
                        <div class="mt-1 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="typcn typcn-th-list-outline tx-24 lh--9 op-6"></i>
                                    </div>
                                </div>
                                <select wire:model.live='pt_slug'
                                    class="custom-select @error('pt_slug') is-invalid @enderror">
                                    <option value="">Semua PT...</option>
                                    @foreach ($dataPT as $dp)
                                    <option value="{{$dp->slug}}">{{$dp->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="mb-3 shadow-sm ">
                            <input type="text" class="form-control card-hover" placeholder="Cari Nomor Surat"
                                wire:model.live='search'>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover  shadow-sm" style="white-space: nowrap">
                        <thead class="">
                            <tr>
                                <th scope="col">
                                    Nomor Surat
                                    <span wire:click="sortBy('nomor_surat')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'nomor_surat' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'nomor_surat' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col">
                                    PT
                                    <span wire:click="sortBy('pt_slug')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'pt_slug' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'pt_slug' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col">
                                    PIC
                                    <span wire:click="sortBy('id_user')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'id_user' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'id_user' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col">
                                    Tanggal Surat
                                    <span wire:click="sortBy('tgl_surat')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'tgl_surat' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'tgl_surat' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    File
                                </th>
                                <th scope="col">
                                    Status
                                    <span wire:click="sortBy('status')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'status' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'status' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            @if (count($noSurat) == 0)
                            <tr>
                                <td colspan="7" class="text-center">tidak ada data</td>
                            </tr>
                            @else
                            @foreach ($noSurat as $ns)
                            <tr>
                                <td>{{$ns->nomor_surat}}</td>
                                <td>{{$ns->pt_slug}}</td>
                                <td>
                                    <p>
                                        <span class="badge badge-dark">{{$ns->user->first_name ??
                                            '-'}}</span>
                                    </p>
                                </td>
                                {{-- <td>{{$ns->tgl_surat}}</td> --}}
                                <td>
                                    @if($ns->tgl_surat)
                                    {{\Carbon\Carbon::parse($ns->tgl_surat)->isoFormat('D MMMM YYYY')}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($ns->status != 0)
                                    @if($ns->file == NULL)
                                    @if($ns->id_user == Auth::user()->id)
                                    <button class="btn btn-sm btn-info" wire:click='uploadFile({{$ns->id}})'
                                        data-toggle="tooltip" data-placement="top" title="unggah file">
                                        <i class="fas fa-file-upload"></i>
                                    </button>
                                    @else
                                    -
                                    @endif
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($ns->status == 0)
                                    <span class="badge badge-warning">tersedia</span>
                                    @elseif($ns->status == 1)
                                    <span class="badge badge-success">terpakai</span>
                                    @elseif($ns->status == 2)
                                    <span class="badge badge-danger">tidak terpakai</span>
                                    @elseif($ns->status == 3)
                                    <span class="badge badge-secondary">backdate</span>

                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($ns->status > 0)
                                    <button class="btn btn-sm btn-primary" wire:click='detail({{$ns->id}})'
                                        data-toggle="tooltip" data-placement="top" title="lihat detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @endif
                                    @if($ns->status == 0 || $ns->status == 2)
                                    <button class="btn btn-sm btn-success" wire:click='pilih({{$ns->id}})'
                                        data-toggle="tooltip" data-placement="top" title="pilih data">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif

                                    @if($ns->status == 1)
                                    <button class="btn btn-sm btn-danger" wire:click='reject({{$ns->id}})'
                                        data-toggle="tooltip" data-placement="top" title="no surat tidak digunakan">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                    @endif
                                    @if($ns->status > 0)
                                    <button class="btn btn-sm btn-az-primary" wire:click='editData({{$ns->id}})'
                                        data-toggle="tooltip" data-placement="top" title="edit data">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    @endif

                                </td>
                            </tr>
                            @endforeach

                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-lg-8">
                        <span>Halaman : {{ $noSurat->currentPage() }} </span><br />
                        <span>Jumlah Data : @if($search == '') {{$noSurat->total()}} @else
                            {{$noSurat->count() }}
                            @endif</span><br />
                        <span>Data Per Halaman : {{ $noSurat->perPage()}} </span><br /><br />
                    </div>
                    <div class="col-12 col-lg-4 d-flex justify-content-end">
                        {{$noSurat->links()}}

                    </div>
                </div>

                <hr class="mg-y-30">



                <div class="ht-40"></div>
                <div class="ht-40"></div>
                <div class="ht-40"></div>


            </div><!-- az-content-body -->
        </div><!-- container -->
    </div><!-- az-content -->
</div>