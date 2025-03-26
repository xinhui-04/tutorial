<x-app-layout>
    {{-- Optional header --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2>
    </x-slot> --}}

    <x-content>
        Hello Admin
    </x-content>

    @if (session('show_popup'))
    <div id="popupAlert"
        class="fixed top-4 left-4 max-w-sm bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-3 py-2 shadow-md"
        role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <img src="{{ asset('images/Icon/cynical.gif') }}" alt="Gif" class="w-12 h-12">
            </div>
            <div>
                <p class="font-bold">Welcome back, Admin!</p>
            </div>
        </div>
    </div>

    <script>
        // Automatically close after 3 seconds
        setTimeout(() => {
            document.getElementById('popupAlert').style.display = 'none';
        }, 3000);
    </script>

    @php session()->forget('show_popup') @endphp
@endif

</x-app-layout>
