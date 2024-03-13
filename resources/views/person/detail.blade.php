<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Person') }} | {{$person->firstname}} {{$person->lastname}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Person Details</h3>
                            <dl>
                                <dd>
                                <span class="sm:col-span-3">
                                @if ($person->image)
                                <img src="{{ asset('storage/images/' . basename($person->image)) }}" alt="Current Image" class="mb-2" style="max-width: 10rem;">
                                <p class="text-gray-500">Profile Picture</p>
                                @endif
                            </span>
                                </dd>
                                <dt class="font-semibold">Name</dt>
                                <dd class="pl-3">{{$person->firstname}} {{$person->lastname}}</dd>
                                <dt class="font-semibold">Phone</dt>
                                <dd class="pl-3">{{$person->phone}}</dd>
                                <dt class="font-semibold">Email</dt>
                                <dd class="pl-3">{{$person->email}}</dd>
                            </dl>
                            <div class="pt-3 flex justify-end items-end">
                                <a href="{{ route('person.edit', $person->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-full font-semibold text-xs uppercase tracking-widest text-black hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                    <span class="mr-2">Edit Person</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>