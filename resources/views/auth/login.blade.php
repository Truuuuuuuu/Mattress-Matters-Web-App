
<x-layout :hideNavbar="false" >
    <x-slot:heading>Log in</x-slot:heading>
    <div class="grid lg:grid-cols-2 max-w-full h-screen ">
        <div class="hidden lg:block h-screen">
            <img src="{{ asset('images/photo1.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="flex items-center justify-center text-base-content">
            <div class="w-full lg:max-w-md mx-auto px-6">
                <h2 class="text-center text-lg font-bold ">Log in or sign up</h2>
                <x-divider class="bg-gray-300 mt-5"></x-divider>
                <h1 class="font-semibold mt-5  text-xl ">Welcome to Mattress Matters</h1>
                <x-forms.form method="POST" action="/login" class="mt-5" >
                    <x-forms.input :label="false" name="email" type="email" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Email" />
                    <x-forms.error name="email"/>
                    <x-forms.input :label="false" name="password" type="password" class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Password" />
                    <x-forms.error name="password"/>
                    <a href="#" class="block text-end -mt-5 hover:text-blue-700">Forgot Password?</a>

                    <x-forms.button class="btn btn-primary w-full btn-lg lg:btn-md ">Log in</x-forms.button>
                </x-forms.form>

                <x-divider class="bg-blue-900 my-10"></x-divider>

                <div class="flex flex-col gap-2 mt-5">
                    <!-- Google -->
                    <a href="{{route('social.redirect', 'google')}}" class="btn bg-white text-black border-black">
                        <svg aria-label="Google logo" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g><path d="m0 0H512V512H0" fill="#fff"></path><path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path><path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path><path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path><path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55"></path></g></svg>
                        Continue with Google
                    </a>

                    <!-- Facebook -->
                    <a href="{{route('social.redirect', 'facebook')}}" class="btn bg-white border border-black text-gray-700 hover:bg-gray-100 gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="20"
                            height="20"
                        >
                            <path
                                fill="#1877F2"
                                d="M24 12a12 12 0 1 0-13.875 11.875v-8.4H7.078V12h3.047V9.356c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.513c-1.49 0-1.953.925-1.953 1.874V12h3.328l-.532 3.475h-2.796v8.4A12 12 0 0 0 24 12z"
                            />
                        </svg>
                        Continue with Facebook
                    </a>
                </div>
                <p class="text-center text-sm mt-5">Don't have an account? <a href="/email-register" class="text-blue-600">Sign up</a></p>
            </div>
        </div>
    </div>
</x-layout>


