<x-guest-layout>
 @if (!Auth::guest())
 <script>
     window.location.href='/dashboard'
 </script>
 @endif   
<div class="login">
    <div class="h-100 flex">
        <div class=" w-50  flex flex-wrap content-center ">
            <div class="w-50 m-auto">
                <a href="/">
                    <x-application-logo class=" fill-current" />
                </a>
            </div>
        </div>
        <div class=" w-50 flex flex-wrap content-center">
            <div class="w-100 mb-4">
                <h1 class="text-white text-5xl font-bold text-center">Entrar</h1>
            </div>
            <div class="w-100 mb-4">
                <p class="c-white text-center">Al sistema de Administración de Recursos Informativos</p>

            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="flex flex-col items-center w-100" action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-5 w-90">
                    <label for="email" class="fz-20 c-white ml-2">Correo</label>
                    <input class="input pl-2" id="email" name="email" type="email" :value="old('email')" required autofocus>
                </div>
                <div class="mb-5 w-90">
                    <label for="password" class="fz-20 c-white ml-2">Contraseña</label>
                    <input class="input pl-2" id="password" name="password" type="password" required autocomplete="current-password">
                </div>
                <!-- Remember Me -->
                <div class="block mt-2 mb-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="mb-6 flex justify-center">
                    <button  class="btn-default fz-20 " type="submit">Entrar</button>
                </div>
                <div class="mb-3 flex justify-center">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>
