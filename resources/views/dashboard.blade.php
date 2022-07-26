<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Yes
        </h2>
    </x-slot>

    <x-slot name="powergrid">
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <div class="bg-white p-4 border border-gray-200 rounded">
                            <livewire:power-grid-demo-table/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
