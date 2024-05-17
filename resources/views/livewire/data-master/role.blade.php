<div>
    @include('modal.data-master.role-modal')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('layouts.sidebar-data-master')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Data Master</span>
                    <span>Role</span>
                    <span>Daftar Role</span>
                </div>
                <h2 class="az-content-title">Daftar Role</h2>

                <div class="az-content-label mg-b-5">
                    <div class="mg-b-20">
                        <button class="btn btn-az-primary" data-toggle="modal" data-target="#tambahData">Tambah
                            Data</button>
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
                    <div class="col-12 col-lg-3">
                        <div class="mb-3 shadow-sm ">
                            <input type="text" class="form-control card-hover" placeholder="Cari nama"
                                wire:model.live='search'>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover mg-b-0" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>Nama
                                    <span wire:click="sortBy('name')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'name' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'name' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($role) == 0)
                            <tr>
                                <td colspan="2" class="text-center">tidak ada data.</td>
                            </tr>
                            @else
                            @foreach ($role as $r)
                            <tr>
                                <td>{{$r->name}}</td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-primary" wire:click='ubah({{$r->id}})'
                                            data-toggle="tooltip" data-placement="top" title="ubah">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <span class="ml-1"></span>
                                        <button class="btn btn-sm btn-danger" wire:click='hapus({{$r->id}})'
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
                        <span>Halaman : {{ $role->currentPage() }} </span><br />
                        <span>Jumlah Data : @if($search == '') {{$role->total()}} @else
                            {{$role->count() }}
                            @endif</span><br />
                        <span>Data Per Halaman : {{ $role->perPage()}} </span><br /><br />
                    </div>
                    <div class="col-12 col-lg-4 d-flex justify-content-end">
                        {{$role->links()}}

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