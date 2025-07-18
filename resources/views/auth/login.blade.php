<x-layout> 
    <x-slot:heading>
        Login
    </x-slot:heading>
    <form method="POST" action="/login">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <x-form-field>
                        <div class="mt-2">
                            <x-form-label for="email">Email</x-form-label>
                            <x-form-input type="email" name="email" id="email" placeholder="$50,000 USD" required/>
                            <x-form-error name="email"/>
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <div class="mt-2">
                            <x-form-label for="password">Password</x-form-label>
                            <x-form-input type="password" name="password" id="password" placeholder="$50,000 USD" required/>
                            <x-form-error name="password"/>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <x-form-button>Login</x-form-button>
        </div>
    </form>
</x-layout>