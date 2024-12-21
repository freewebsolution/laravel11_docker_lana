<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Ticket: ') . $ticket->title }}
        </h2>
    </x-slot>

    <!-- Contenuto del ticket -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ $ticket->title }}</h3>
                    <p class="mb-4">
                        <span class="font-semibold text-gray-600">Status:</span>
                        <span class="{{ $ticket->status ? 'text-yellow-500' : 'text-green-500' }}">
                            {{ $ticket->status ? 'Pending' : 'Answered' }}
                        </span>
                    </p>
                    <p class="mb-6 text-gray-700">{{ $ticket->content }}</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('tickets.edit', $ticket->slug) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Edit
                        </a>
                        <!-- Bottone per la cancellazione con conferma -->
                        <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" x-data
                            @click="$dispatch('open-delete-modal', '{{ route('tickets.destroy', $ticket->slug) }}')">
                            Delete
                        </button>
                    </div>
                </div>
                        <!-- Form di commento -->
        <div class="mt-6">
            <form method="post" action="/comment" class="bg-white p-6 rounded-lg shadow-lg">
                @foreach($errors->all() as $error)
                    <p class="text-red-500 text-sm">{{ $error }}</p>
                @endforeach

                @if(session('status'))
                    <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                @csrf
                <input type="hidden" name="post_id" value="{{ $ticket->id }}">

                <fieldset>
                    <legend class="text-lg font-semibold mb-3">Reply</legend>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="3" id="content" name="content" placeholder="Write your reply..."></textarea>
                        </div>
                    </div>

                    <div class="form-group mt-4 flex justify-end space-x-4">
                        <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Post</button>
                    </div>
                </fieldset>
            </form>
        </div>
            </div>
        </div>

    </div>

    <!-- Modal di conferma per la cancellazione -->
    <div x-data="{ open: false, deleteUrl: '' }" @open-delete-modal.window="open = true; deleteUrl = $event.detail" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-1/3">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Confirm Delete</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this ticket? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
                <button @click="open = false"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Cancel</button>
                <form :action="deleteUrl" method="POST" x-ref="form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
