<x-app-layout>

    <div class="container mx-auto">
        @include('includes.message')
        @include('includes.error')
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('save.user')}}" method="POST" id="user" >
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6 relative">

                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre(s)</label>
                                <input type="text" name="name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  required>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="lastname" class="block text-sm font-medium text-gray-700">Apellido(s)</label>
                                <input type="text" name="lastname" id="lastname" autocomplete="lastname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-4">

                            <div class="col-span-6 sm:col-span-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electronico</label>
                                <input type="email" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                                <input type="password" name="password" id="password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  required>
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-4">

                            <div class="col-span-6 sm:col-span-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefono</label>
                                <input type="text" name="phone" id="phone" autocomplete="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="position" class="block text-sm font-medium text-gray-700">Posición</label>
                                <input type="text" name="position" id="position" autocomplete="position" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  required>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">
                                    Rol
                                </label>
                                <div class="mt-1">
                                    <select name="role" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}" >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                <label for="status" class="block text-sm font-medium text-gray-700">
                                    Estatus
                                </label>
                                <div class="mt-1">
                                    <select name="status" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                        <option value="">Seleccionar</option>
                                        <option value="ACTIVO" >ACTIVO</option>
                                        <option value="INACTIVO" >INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                    </div>

                    <div class="px-4 py-3  text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
