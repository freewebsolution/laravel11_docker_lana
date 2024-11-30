<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tickets') }}
        </h2>
    </x-slot>

    <!-- Contenuto dei biglietti -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($tickets->isEmpty())
                        <p class="text-center text-gray-500">There are no tickets available.</p>
                    @else
                        <table class="w-full table-auto border-collapse text-sm">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr class="border-b border-gray-300 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm">{{ $ticket->id }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $ticket->title }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ $ticket->status ? 'Pending' : 'Answered' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="inline-flex space-x-4">
                                                <a href="{{ route('tickets.show', $ticket->slug) }}"
                                                    class="text-blue-500 hover:text-blue-700">View</a>
                                                <a href="{{ route('tickets.edit', $ticket->slug) }}"
                                                    class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                                <button class="text-red-500 hover:text-red-700" x-data
                                                    @click="$dispatch('open-delete-modal', '{{ route('tickets.destroy', $ticket->slug) }}')">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modale di conferma -->
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
