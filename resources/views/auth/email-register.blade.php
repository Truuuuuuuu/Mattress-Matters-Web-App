<x-layout :hideNavbar="false" >
    <x-slot:heading>Register</x-slot:heading>
    <div class="min-h-[calc(100vh-4rem)] flex items-center justify-center">

        <div class="w-full max-w-md p-10">
            <h1 class="text-center text-3xl mb-6 font-bold">Sign up</h1>
            <x-forms.form method="POST" action="/email-register">
                <x-forms.input :label="false" name="name" type="text" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Full Name" />
                <x-forms.input :label="false" name="email" type="email" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Email" />
                <x-forms.input :label="false" name="password" type="password" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Password" />
                <x-forms.input :label="false" name="password_confirmation" type="password" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Confirm Password" />

                <div class="grid grid-cols-2 gap-4">
                    <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                        <input type="radio" name="role" value="host" class="hidden peer" />
                        <div class="peer-checked:font-bold">
                            Host
                        </div>
                        <p class="text-sm text-base-content/70">
                            List and manage your property
                        </p>
                    </label>

                    <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                        <input type="radio" name="role" value="tenant" class="hidden peer" />
                        <div class="peer-checked:font-bold">
                            Tenant
                        </div>
                        <p class="text-sm text-base-content/70">
                            Find and rent properties
                        </p>
                    </label>
                </div>
                @error('role')
                <p class="text-red-500 text-sm">Please select a role</p>
                @enderror

                <p class="text-sm">By selecting <strong>Agree and Continue</strong>, I agree to Mattress Matters's <span class="text-blue-800 underline">Terms of Service,
                    </span >and <span class="text-blue-800 underline">Nondiscrimation Policy</span > and acknowledge the <span class="text-blue-800 underline"> Privacy Policy.</span></p>


                <x-forms.button class="btn btn-primary w-full">Agree and Continue</x-forms.button>
            </x-forms.form>

            <x-divider class="bg-blue-900 mt-10"/>

            <div class="flex flex-col gap-2 mt-5">
                <!-- Google -->
                <a href="{{route('social.redirect', 'google')}}" class="btn bg-white text-black border-[#e5e5e5]">
                    <svg aria-label="Google logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g><path d="m0 0H512V512H0" fill="#fff"></path><path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path><path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path><path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path><path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55"></path></g></svg>
                    Continue with Google
                </a>

                <!-- Facebook -->
                <button class="btn bg-[#1A77F2] text-white border-[#005fd8]">
                    <svg aria-label="Facebook logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="white" d="M8 12h5V8c0-6 4-7 11-6v5c-4 0-5 0-5 3v2h5l-1 6h-4v12h-6V18H8z"></path></svg>
                    Contiue with Facebook
                </button>
            </div>
            <p class="lg:text-sm mt-2">Already have an account? <a href="/login" class="text-blue-800 ">Sign in</a></p>
        </div>
    </div>
</x-layout>
