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
                        <a href="{{ route('tickets.edit', $ticket->id) }}" 
                            class="btn primary ">
                            Edit
                        </a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="btn danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
