<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
          <center><img class="mb-3" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="120" width="120"></center>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="login-box">
          <!-- /.login-logo -->
          <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="https://adminlte.io/" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
              <p class="login-box-msg">Sign in to start your session</p>

              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3 ml-5">
                  <!--<x-input-label for="email" :value="__('Email')" />-->

                <x-text-input id="email" class="block mt-1 w-full" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3 ml-5">
                  <!--<x-input-label for="password" :value="__('Password')" />-->

                <x-text-input id="password" class="block mt-1 w-full"
                                placeholder="Password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                        <label for="remember_me">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
              </p>
              <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
              </p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </x-auth-card>
</x-guest-layout>