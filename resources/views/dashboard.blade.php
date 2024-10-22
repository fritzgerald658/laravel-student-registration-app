<x-app-layout>
    <header>
        <x-admin-components.navbar title="Admin Dashboard" />
    </header>
    <div class="mx-5 flex flex-col gap-5">
        <x-admin-components.btn-add-students />
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table">
                    <x-admin-components.table-heading />
                    <x-admin-components.table-content :students="$students" />
                </table>
            </div>
        </div>
    </div>
    <div>
        @if ($errors->any()){
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            }
        @endif
    </div>
    <x-admin-components.add-student-modal />
    <x-admin-components.update-student-modal />

    {{-- Ajax add students --}}
    {{-- @vite('resources/js/admin.js') --}}
</x-app-layout>
