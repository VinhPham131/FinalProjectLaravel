<div class="flex-row justify-between">
    <div class="flex justify-center pt-6">
        <x-logo-icon />
    </div>

    <div class="flex justify-center">
        @if ($mode == 'login')
            <x-auth.login-form />
        @elseif ($mode == 'register')
            <x-auth.register-form />
        @endif
    </div>
</div>