<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- Affichage des erreurs de validation --}}
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Adresse email --}}
            <div class="block">
                <x-label for="email" value="{{ __('Adresse e-mail') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            {{-- Nouveau mot de passe --}}
            <div class="mt-4">
                <x-label for="password" value="{{ __('Nouveau mot de passe') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                         required autocomplete="new-password" />
            </div>

            {{-- Confirmation du mot de passe --}}
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmer le mot de passe') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- Bouton de validation --}}
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Réinitialiser le mot de passe') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
