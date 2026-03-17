<x-layout :hideNavbar="false" >
    <x-slot:heading>Register</x-slot:heading>
    <div class="h-screen flex items-center justify-center mt-10">

        <div class="w-full max-w-md p-10">
            <h1 class="text-center text-2xl mb-6 font-bold ">Finish signing up</h1>
            <x-divider class="mb-5 bg-gray-500"/>
            <x-forms.form method="POST" action="/google-register">
                {{--google id--}}
                <input type="hidden" name="provider_id" value="{{ old('provider_id', $provider_id ?? '') }}">

                <h2 class="m-auto">Legal Name</h2>
                <x-forms.input :label="false" name="name" value="{{old('name', $fullName ?? '')}}" type="text" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="First Name" />
                <p class="-mt-5 text-xs text-base-content/50">Make sure this matches the name on your government ID.</p>

                <h2 class="m-auto">Contact Info</h2>
                <x-forms.input readonly :label="false" name="email" value="{{old('email', $email ?? '')}}" type="email" class="bg-gray-200 rounded-xl input input-lg lg:input-md" placeholder="Email" />
                <p class="-mt-5 text-xs text-base-content/50">We'll email you information</p>

                <div class="grid grid-cols-2 gap-4">
                    <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                        <input type="radio" name="role" value="host" class="hidden peer" onchange="toggleTenantFields(this)"/>
                        <div class="peer-checked:font-bold">
                            Host
                        </div>
                        <p class="text-sm text-base-content/70">
                            List and manage your property
                        </p>
                    </label>

                    <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                        <input type="radio" name="role" value="tenant" class="hidden peer" onchange="toggleTenantFields(this)"/>
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

                {{-- tenant only fields --}}
                <div id="tenantFields" class="hidden space-y-4 mt-4">
                    <div>
                        <label for="gender">Gender</label>
                        <select  id="gender" name="gender" class="select select-neutral w-full rounded-xl [&:has(option[disabled]:checked)]:opacity-50">
                            <option disabled selected >Choose gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                        <p class="text-red-500 text-sm">Please select a gender</p>
                        @enderror
                    </div>
                    <div >
                        <label for="occupation">Occupation</label>
                        <select id="occupation" name="occupation" class="select select-neutral w-full rounded-xl [&:has(option[disabled]:checked)]:opacity-50">
                            <option disabled selected >Choose occupation</option>
                            <option value="student">Student</option>
                            <option value="working_individual">Working Individual</option>
                        </select>
                        @error('occupation')
                        <p class="text-red-500 text-sm">Please select an occupation</p>
                        @enderror
                    </div>
                </div>

                <p class="text-base-content text-center text-sm">This info came from Google</p>

                <p class="text-sm">By selecting <strong>Agree and Continue</strong>, I agree to Mattress Matters's <span class="text-blue-800 underline">Terms of Service,
                    </span >and <span class="text-blue-800 underline">Nondiscrimation Policy</span > and acknowledge the <span class="text-blue-800 underline"> Privacy Policy.</span></p>


                <x-forms.button class="btn btn-primary w-full">Agree and Continue</x-forms.button>
            </x-forms.form>

            <x-divider class="bg-blue-900 "/>



        </div>
    </div  >
</x-layout>


<script>
    function toggleTenantFields(input) {
        const tenantFields = document.getElementById('tenantFields');
        tenantFields.classList.toggle('hidden', input.value !== 'tenant');
    }
</script>
