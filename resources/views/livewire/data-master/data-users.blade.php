<div>
    @include('modal.data-master.data-users-modal')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('layouts.sidebar-data-master')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Data Master</span>
                    <span>Data Users</span>
                    <span>Daftar Users</span>
                </div>
                <h2 class="az-content-title">Daftar Users</h2>

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
                            <input type="text" class="form-control card-hover" placeholder="Cari data"
                                wire:model.live='search'>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover mg-b-0" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>
                                    Username
                                    <span wire:click="sortBy('username')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'username' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'username' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th>
                                    Nama
                                    <span wire:click="sortBy('first_name')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'first_name' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'first_name' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th scope="col">
                                    PT
                                    <span wire:click="sortBy('pt_id')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'pt_id' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'pt_id' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th>
                                    Jenis Kelamin
                                    <span wire:click="sortBy('jk')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'jk' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'jk' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th>
                                    Role
                                    <span wire:click="sortBy('role_id')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'role_id' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'role_id' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th>
                                    Lupa Password
                                    <span wire:click="sortBy('is_password')" style="cursor: pointer; font-size: 10px">
                                        <i
                                            class="fa fa-arrow-up {{$sortField === 'is_password' && $sortDirection === 'asc' ? '' : 'text-muted'}} "></i>
                                        <i
                                            class="fa fa-arrow-down {{$sortField === 'is_password' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i>
                                    </span>
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) == 0)
                            <tr>
                                <td colspan="6" class="text-center">tidak ada data.</td>
                            </tr>
                            @else
                            @foreach ($users as $u)
                            <tr>
                                <td>{{$u->username}}</td>
                                <td>{{$u->first_name}} {{$u->last_name}}</td>
                                <td>{{$u->pt->slug}}</td>
                                <td>
                                    @if ($u->jk == 'l')
                                    Laki-laki
                                    @else
                                    Perempuan
                                    @endif
                                </td>
                                <td><span class="badge badge-primary">{{$u->role->name}}</span></td>
                                <td class="">
                                    <div class="d-flex justify-content-center">
                                        @if ($u->is_password == 0)
                                        -
                                        @else

                                        <button class="btn btn-danger btn-icon btn-rounded"
                                            wire:click='resetPasswordUser("{{ $u->id }}")'>
                                            <i class="typcn typcn-warning"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-secondary"
                                            wire:click='resetPasswordUser("{{ $u->id }}")' data-toggle="tooltip"
                                            data-placement="top" title="reset password">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" wire:click='ubah("{{$u->id}}")'
                                            data-toggle="tooltip" data-placement="top" title="ubah">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click='hapus("{{$u->id}}")'
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
                        <span>Halaman : {{ $users->currentPage() }} </span><br />
                        <span>Jumlah Data : @if($search == '') {{$users->total()}} @else
                            {{$users->count() }}
                            @endif</span><br />
                        <span>Data Per Halaman : {{ $users->perPage()}} </span><br /><br />
                    </div>
                    <div class="col-12 col-lg-4 d-flex justify-content-end">
                        {{$users->links()}}

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