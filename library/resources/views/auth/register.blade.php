<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo" >
            <center><img style="margin-top: 100px;" class="mb-3" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="120" width="120"></center>
        </x-slot>

        <div class="register-box">
          <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="https://adminlte.io/" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
              <p class="login-box-msg">Register a new membership</p>

              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3 ml-5">
                  <x-text-input id="name" placeholder="Full name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="input-group mb-3 ml-5">
                  <x-text-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-group mb-3 ml-5">
                  <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required autocomplete="new-password" />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="input-group mb-3 ml-5">
                  <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                placeholder="Retype password"
                                name="password_confirmation" required />

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="row">
                  <div class="mb-2 col-6" style="margin-left: 80px;">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <center><a href="{{ route('login') }}" class="text-center">I already have a membership</a></center>
            </div>
            <!-- /.form-box -->
          </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </x-auth-card>
</x-guest-layout>