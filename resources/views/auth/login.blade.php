
<x-layout :hideNavbar="false" noPadding>
    <x-slot:heading>Log in</x-slot:heading>
    <div class="grid lg:grid-cols-2 max-w-full h-screen ">
        <div class="hidden lg:block h-screen">
            <img src="{{ asset('images/photo1.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="flex items-center justify-center text-base-content">
            <div class="w-full lg:max-w-md mx-auto px-6">
                <h1 class="text-center text-3xl font-bold ">Log in</h1>
                <x-forms.form method="POST" action="/login" class="mt-5" >
                    <x-forms.input :label="false" name="email" type="email" class="input input-primary input-lg lg:input-md" placeholder="Email"/>
                    <x-forms.input :label="false" name="password" type="password" class="input input-primary input-lg lg:input-md" placeholder="Password"/>

                    <a href="#" class="block text-end -mt-5 hover:text-blue-700">Forgot Password?</a>

                    <x-forms.button class="btn btn-primary w-full btn-lg lg:btn-md ">Log in</x-forms.button>
                </x-forms.form>

                <x-divider class="bg-blue-900"></x-divider>

                <div class="flex justify-between mt-5">
                    <!-- Google -->
                    <button class="btn bg-white text-black border-[#e5e5e5]">
                        <svg aria-label="Google logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g><path d="m0 0H512V512H0" fill="#fff"></path><path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path><path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path><path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path><path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55"></path></g></svg>
                        Login with Google
                    </button>

                    <!-- Facebook -->
                    <button class="btn bg-[#1A77F2] text-white border-[#005fd8]">
                        <svg aria-label="Facebook logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="white" d="M8 12h5V8c0-6 4-7 11-6v5c-4 0-5 0-5 3v2h5l-1 6h-4v12h-6V18H8z"></path></svg>
                        Login with Facebook
                    </button>
                </div>
                <p class="text-center text-sm mt-5">Don't have an account? <a href="/register" class="text-blue-600">Sign up</a></p>
            </div>
        </div>
    </div>
</x-layout>


