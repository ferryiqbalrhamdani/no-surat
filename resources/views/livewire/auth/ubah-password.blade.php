<div>
    <div class="az-signin-wrapper mt-4">
        <div class="az-card-signin">
            <h1 class="az-logo">No Surat App</h1>
            <div class="az-signin-header">
                <h5>Masukan password baru anda</h5>



                <form wire:submit.prevent='ubah'>
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input @if($showpassword==false) type="password" @else type="text" @endif
                                class="form-control  @error('password') is-invalid @enderror" wire:model.live='password'
                                id="password" placeholder="password">
                            <div class="input-group-append">
                                <label class="input-group-text" for="password">
                                    <span class="fas fa-lock"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input @if($showpassword==false) type="password" @else type="text" @endif
                                class="form-control  @error('confirmPassword') is-invalid @enderror"
                                wire:model.live='confirmPassword' id="confirmPassword" placeholder="confirm password">
                            <div class="input-group-append">
                                <label class="input-group-text" for="confirmPassword">
                                    <span class="fas fa-lock"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            @error('confirmPassword')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" wire:click='openPas()'>
                        <label for="remember">
                            Tampilkan Password
                        </label>
                    </div>

                    <!-- /.col -->
                    <button type="submit" class="btn btn-az-primary btn-block">Ubah</button>
                    {{-- <a href="/dashboard" class="btn btn-primary btn-block">Kirim</a> --}}
                    <!-- /.col -->

                </form>
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
                <p><a href="/login">Login</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
</div>