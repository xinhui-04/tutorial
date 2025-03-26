<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You are late!
                </div>
            </div>
        </div>
    </div>

    @if (session('show_popup'))
    <div id="popupAlert"
        class="fixed top-4 left-4 max-w-sm bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md"
        role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <img src="{{ asset('images/Icon/party.gif') }}" alt="Gif" class="w-12 h-12">
            </div>
            <div>
                <p class="font-bold text-yellow-700">Welcome~  Staff!</p>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('popupAlert').style.display = 'none';
        }, 3000);
    </script>

    @php session()->forget('show_popup') @endphp
@endif


</x-app-layout>