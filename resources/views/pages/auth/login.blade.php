<x-layouts::auth :title="__('Log in')">
    <div class="w-full max-w-md">

        {{-- Header --}}
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900 shadow-md">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    class="h-7 w-7 text-white"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 21h16.5M5.25 21V7.5L12 3l6.75 4.5V21M8.25 21v-6.75h7.5V21M8.25 10.5h.008v.008H8.25V10.5Zm3.746 0h.008v.008h-.008V10.5Zm3.754 0h.008v.008h-.008V10.5Z"
                    />
                </svg>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                SIKARA
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Sistem Inventaris Kantor Imigrasi Ngurah Rai
            </p>
        </div>

        {{-- Login Card --}}
        <div class="rounded-xl border border-slate-300 bg-white p-6 shadow-md sm:p-8">

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-900">
                    Masuk ke akun
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Silakan masukkan email dan password Anda.
                </p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status
                class="mb-4 text-center text-sm"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-slate-900"
                    >
                        Email address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-medium text-slate-900"
                    >
                        Password
                    </label>

                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 pr-11 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        />

                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 transition hover:text-slate-700"
                            aria-label="Show password"
                        >
                            <svg
                                id="eyeIcon"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mt-2 flex justify-end">
                            <a
                                href="{{ route('password.request') }}"
                                class="text-xs font-medium text-blue-600 transition hover:text-blue-700"
                                wire:navigate
                            >
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif

                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Login Button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    data-test="login-button"
                >
                    {{ __('Log in') }}
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-xs text-slate-400">
            SIKARA &mdash; Sistem Inventaris Kantor Imigrasi Ngurah Rai
        </p>

    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 2.036 12.322a1.012 1.012 0 0 0 0 .644C3.423 17.49 7.36 20.5 12 20.5c1.915 0 3.72-.503 5.286-1.384M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.64 0 8.577 3.01 9.964 7.178a1.012 1.012 0 0 1 0 .644 10.523 10.523 0 0 1-4.132 5.178M6.228 6.228 3 3m3.228 3.228 12.544 12.544M9.88 9.88a3 3 0 0 0 4.24 4.24"
                    />
                `;
            } else {
                password.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.21.07.434 0 .644C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                `;
            }
        }
    </script>
</x-layouts::auth>