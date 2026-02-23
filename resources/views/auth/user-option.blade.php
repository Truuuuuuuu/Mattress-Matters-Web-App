<x-layout :hideNavbar="false" >
    <x-slot:heading>Choose</x-slot:heading>
        <div class="flex justify-center items-center h-screen py-50 gap-10">
            <a href="/register">
                <div class="group card bg-base-100 w-96 shadow-sm flex flex-col border border-black drop-shadow-lg hover:border-blue-900
                    hover:border-2 transition-colors duration-300">
                    <div class="flex justify-center pt-10">
                        <img src="{{asset('/images/renter-option.png')}}" alt="" class="w-20 lg:w-40 h-auto">
                    </div>
                    <div class="card-body">
                        <h2 class="group-hover:text-blue-900 text-md font-bold lg:card-title text-center block transition-colors duration-300">
                            I want to rent
                        </h2>
                    </div>
                </div>
            </a>

            <a href="/register">
                <div class="group host card bg-base-100 w-96 shadow-sm flex flex-col border border-black drop-shadow-lg hover:border-blue-900
                    hover:border-2 transition-colors duration-300">
                    <div class="flex justify-center pt-10">
                        <img src="{{asset('/images/host-option.png')}}" alt="" class="w-20 lg:w-40 h-auto">
                    </div>
                    <div class="card-body">
                        <h2 class="group-hover:text-blue-900 text-md font-bold lg:card-title text-center block transition-colors duration-300">
                            Become a Host
                        </h2>
                    </div>
                </div>
            </a>

        </div>
</x-layout>
