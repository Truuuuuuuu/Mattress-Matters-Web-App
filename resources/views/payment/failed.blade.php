<x-layout>
    <x-slot:heading>Payment Failed!</x-slot:heading>
    <div class="flex flex-col items-center justify-center min-h-screen ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="size-20">
            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
        </svg>


        <h2 class="text-2xl font-bold text-red-600">Payment Failed or Cancelled</h2>
        <p class="-mt-1 text-gray-500 ">Something went wrong. Please try again.</p>
        <a href="{{route('reservation.index')}}" class="mt-6 btn btn-primary px-10">Go Back</a>
    </div>
</x-layout>
