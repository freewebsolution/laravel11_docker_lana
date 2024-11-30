<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tickets.update', $ticket->slug) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    

                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 bg-red-100 border border-red-400 rounded-md p-2 mb-2">{{ $error }}</p>
                        @endforeach

                        @if (session('status'))
                            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="title" class="block text-gray-700 font-semibold">Title</label>
                            <input type="text" id="title" name="title" value="{{ $ticket->title }}" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Ticket Title">
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block text-gray-700 font-semibold">Content</label>
                            <textarea id="content" name="content" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Describe your ticket">{{ $ticket->content }}</textarea>
                            <span class="text-gray-500 text-sm">Feel free to ask us any question.</span>
                        </div>

                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="status" {{ $ticket->status ? '' : 'checked' }} class="mr-2">
                            <label for="status" class="text-gray-700 font-semibold">Close this ticket?</label>
                        </div>

                        <div class="flex justify-between">
                            <a href="{{ route('tickets.index') }}" class="btn cancel">Cancel</a>
                            <button type="submit" class="btn dark">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
