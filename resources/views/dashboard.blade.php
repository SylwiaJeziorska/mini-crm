<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in') }} {{ Auth::user()->name }}!
                    </div>
                    <button class="btn  btn-sm"><a href="{{ route('employees.index') }}">Eployees</a></button>
                    <button class="btn  btn-sm"><a href="{{route('companies.index')}}">Companies</a></button>
                </div>
        </div>
    </div>
</x-app-layout>
