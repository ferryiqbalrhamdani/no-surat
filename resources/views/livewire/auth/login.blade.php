<div>
    <div class="az-signin-wrapper mt-4">
        <div class="az-card-signin">
            <h1 class="az-logo">No Surat App</h1>
            <div class="az-signin-header">
                <h2>Selamat datang!</h2>
                <h5>Mohon sign in untuk melanjutkan</h5>

                <form wire:submit.prevent='loginAction'>
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control  @error('username') is-invalid @enderror"
                            wire:model.live='username' id="username" placeholder="Username">
                        <div class="input-group-append">
                            <label class="input-group-text" for="username">
                                <span class="fas fa-user"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input id="password" @if($showpassword==false) type="password" @else type="text" @endif
                            class="form-control @error('password') is-invalid @enderror" wire:model.live='password'
                            id="password" placeholder="Password">
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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" wire:click='openPas()'>
                                <label for="remember">
                                    Tampilkan Password
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-az-primary btn-block">Sign In</button>
                            {{-- <a href="/dashboard" class="btn btn-primary btn-block">Login</a> --}}
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
                <p><a href="">Lupa password?</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
</div>