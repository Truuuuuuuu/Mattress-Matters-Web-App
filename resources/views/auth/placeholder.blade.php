<x-layout>
    <x-slot:heading>Login Success</x-slot:heading>

    <h2>Welcome, {{Auth::user()->name}}!</h2>
</x-layout>
