<div>
    @include('modal.data-master.data-no-surat-modal')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('layouts.sidebar-data-master')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Data Master</span>
                    <span>Data No Surat</span>
                    <span>Daftar No Surat</span>
                </div>
                <h2 class="az-content-title">Daftar No Surat</h2>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="az-content-label mg-b-5">
                            <div class="mg-b-20">
                                <button class="btn btn-az-primary" data-toggle="modal" data-target="#tambahData">Tambah
                                    Data</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="az-content-label mg-b-5">
                            <div class="mg-b-20">
                                <button class="btn btn-az-primary" data-toggle="modal" data-target="#tambahTahun">Tambah
                                    Tahun</button>
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
                    <div class="col-12 col-lg-6"></div>

                </div>

                {{-- <div class="table-responsive">
                    <table class="table table-bordered table-hover mg-b-0" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>
                                    Nama
                                    <span wire:click="sortBy('name')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'name' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'name' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th>
                                    Slug
                                    <span wire:click="sortBy('slug')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'slug' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'slug' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($dataPT) == 0)
                            <tr>
                                <td colspan="3" class="text-center">tidak ada data.</td>
                            </tr>
                            @else
                            @foreach ($dataPT as $dp)
                            <tr>
                                <td>{{$dp->name}}</td>
                                <td>{{$dp->slug}}</td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-primary" wire:click='ubah({{$dp->id}})'
                                            data-toggle="tooltip" data-placement="top" title="ubah">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <span class="ml-1"></span>
                                        <button class="btn btn-sm btn-danger" wire:click='hapus({{$dp->id}})'
                                            data-toggle="tooltip" data-placement="top" title="hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @endif

                        </tbody>
                    </table>
                </div><!-- table-responsive -->

                <div class="row mt-3">
                    <div class="col-12 col-lg-8">
                        <span>Halaman : {{ $dataPT->currentPage() }} </span><br />
                        <span>Jumlah Data : @if($search == '') {{$dataPT->total()}} @else
                            {{$dataPT->count() }}
                            @endif</span><br />
                        <span>Data Per Halaman : {{ $dataPT->perPage()}} </span><br /><br />
                    </div>
                    <div class="col-12 col-lg-4 d-flex justify-content-end">
                        {{$dataPT->links()}}

                    </div>
                </div> --}}

                <div class="accordion" id="accordionExample">
                    @foreach ($tahun as $t)
                    <div class="card shadow">
                        <div class="card-header" id="heading{{$t->nama_tahun}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapse{{$t->nama_tahun}}" aria-expanded="true"
                                    aria-controls="collapse{{$t->nama_tahun}}">
                                    Data Tahun {{$t->nama_tahun}}
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{$t->nama_tahun}}"
                            class="collapse @if($t->nama_tahun == $nama_tahun) show @endif"
                            aria-labelledby="heading{{$t->nama_tahun}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($dataPT as $dp)
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header ">
                                                <h6>{{$dp->slug}} </h6>
                                                @if ($dataNosurat->where('pt_slug', $dp->slug)->where('tahun',
                                                $t->nama_tahun)->count() > 0)
                                                <button class="btn btn-success btn-rounded btn-icon ">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                @else
                                                <button class="btn btn-danger btn-rounded btn-icon "><i
                                                        class="typcn typcn-times"></i></button>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>

                <hr class="mg-y-30">



                <div class="ht-40"></div>
                <div class="ht-40"></div>
                <div class="ht-40"></div>


            </div><!-- az-content-body -->
        </div><!-- container -->
    </div><!-- az-content -->
</div>