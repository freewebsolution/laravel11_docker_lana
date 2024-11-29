<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Ticket') }}
        </h2>
    </x-slot>

    <!-- Contenuto del ticket -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 bg-red-100 border border-red-400 rounded-md p-2 mb-2">
                                {{ $error }}
                            </p>
                        @endforeach

                        @csrf <!-- Protezione CSRF -->

                        <!-- Titolo del ticket -->
                        <div class="mb-5">
                            <label for="title" class="block text-gray-700 font-semibold">Title</label>
                            <input type="text" id="title" name="title"
                                class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter ticket title">
                        </div>

                        <!-- Contenuto del ticket -->
                        <div class="mb-5">
                            <label for="content" class="block text-gray-700 font-semibold">Content</label>
                            <textarea id="content" name="content"
                                class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" rows="6"
                                placeholder="Describe your issue" ></textarea>
                        </div>

                        <!-- Pulsanti di azione -->
                        <div class="flex justify-between">
                            <a href="{{ route('dashboard') }}" class="btn primary">Cancel</a>
                            <button type="submit" class="btn dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
