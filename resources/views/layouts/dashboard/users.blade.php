<x-app-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @include('includes.message')
                    @include('includes.error')

                    <div class="py-3 m-3">
                        <a href="{{route('new.user')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nuevo Usuario</a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rol
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($users as $user)
                            @if($user->role != "Administrator" && $user->id != Auth::user()->id)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->email}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$user->role}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{route('edit.report', $user->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                        <a href="{{route('delete.report', $user->id)}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Borrar
                                        </a>
                                    </td>
                                </tr>

                                </span>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="container mx-auto px-4 py-4">
                        {{ $users->links('vendor.pagination.tailwind') }}

                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
