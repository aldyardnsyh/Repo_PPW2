<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('My Favourite Books') }}
        </h2>
    </x-slot>

    <x-slot name="content">
        <div class="container mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favouriteBooks as $favouriteBook)
                        <tr>
                            <td>{{ $favouriteBook->buku->judul }}</td>
                            <td>{{ $favouriteBook->buku->penulis }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
