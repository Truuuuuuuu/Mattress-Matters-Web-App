<x-layout :hideNavbar="false" noPadding>
    <x-slot:heading>Register</x-slot:heading>
    <div class="h-screen flex items-center justify-center">

        <div class="w-full max-w-md p-10">
            <h1 class="text-center text-3xl mb-6">Sign up</h1>
            <x-forms.form method="POST" action="/register">
                <x-forms.input :label="false" name="name" type="text" class="input input-primary input-lg lg:input-md" placeholder="Full Name" />
                <x-forms.input :label="false" name="email" type="email" class="input input-primary input-lg lg:input-md" placeholder="Email" />
                <x-forms.input :label="false" name="password" type="password" class="input input-primary input-lg lg:input-md" placeholder="Password" />
                <x-forms.input :label="false" name="password_confirmation" type="password" class="input input-primary input-lg lg:input-md" placeholder="Confirm Password" />
                <x-forms.button class="btn btn-primary w-full">Sign up</x-forms.button>
            </x-forms.form>
        </div>
    </div>
</x-layout>
