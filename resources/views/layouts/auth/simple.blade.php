<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>

    <body class="min-h-screen bg-gray-100 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center bg-gray-100 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>

            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>