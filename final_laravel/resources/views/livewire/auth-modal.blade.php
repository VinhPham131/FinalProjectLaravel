<div class="block">
    <div class="flex justify-center pt-6">
        <x-logo-icon></x-logo-icon>
    </div>

    <div class="flex justify-center py-6">
        @if ($mode == 'login')
            <x-login-form />
        @else
            <x-register-form />
        @endif
    </div>
</div>
