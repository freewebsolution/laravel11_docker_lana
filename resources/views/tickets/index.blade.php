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
                                @foreach($tickets as $ticket)
                                    <tr class="border-b border-gray-300 hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm">{{ $ticket->id }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $ticket->title }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ $ticket->status ? 'Pending' : 'Answered' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="inline-flex space-x-4">
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
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
</x-app-layout>
