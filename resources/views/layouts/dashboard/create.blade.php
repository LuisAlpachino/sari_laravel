<x-app-layout>
    @push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}" />
    @endpush
    
    @push('scripts')
        <script src="{{asset('js/main.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous"></script>
    @endpush
    
    <div class="container mx-auto">
        <script>
            const baseUrl = "<?=Request::root() ?>";
        </script>
        {{-- <div class="md:grid md:grid-cols-3 md:gap-6"> --}}
            {{-- <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                <p class="mt-1 text-sm text-gray-600">
                This information will be displayed publicly so be careful what you share.
                </p>
            </div>
            </div> --}}
            @include('includes.message')
            @include('includes.error')
            <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('save.report')}}" method="POST" id="report" >
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6 relative">
                    @if(isset($edit) && $edit = true)
                        <h3 class="text-2xl">Editar reporte</h3>
                    @else
                        <h3 class="text-2xl">Nuevo reporte</h3>
                    @endif
                    
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-5">
                          <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                          <input type="text" name="title" id="title" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$report->title}}" required>
                        </div>

                        <div class="col-span-6 sm:col-span-1">
                            <label for="folio" class="block text-sm font-medium text-gray-700">Folio</label>
                            <input type="text" name="folio" id="folio" autocomplete="folio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$report->id}}" disabled>
                            <input type="hidden" name="report_id" value="{{$report->id}}" />
                          </div>

                    </div>
                    
                    <div>
                        <label for="summary" class="block text-sm font-medium text-gray-700">
                            Resumen de noticia
                        </label>
                        <div class="mt-1">
                            <textarea id="summary" name="summary" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" required>{{$report->summary}}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">
                            Cuerpo de noticia
                        </label>
                        <div class="mt-1">
                            <textarea id="content" name="content" rows="8" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" required>{{$report->content}}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">
                            Tipo de noticia
                        </label>
                        <div class="mt-1">
                            <select name="type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="">Seleccionar</option>
                                @foreach ($news_types as $type)
                                    <option value="{{$type->id}}" {{ $type->id == $report->fk_news_types ? 'selected' :'' }}>{{$type->name}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="state" name="state" autocomplete="state" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="">Seleccionar</option>
                              @foreach ($states as $state)
                                  <option value="{{$state->id}}" @isset($municipality) {{ $state->id == $municipality->state->id ? 'selected' :'' }} @endisset>{{ $state->name}}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                          <label for="municipality" class="block text-sm font-medium text-gray-700">Municipio</label>
                          <input type="hidden" value="{{$municipality->id ?? ''}}" id="municipalityId" />
                          <select id="municipality" name="municipality" autocomplete="municipality" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Seleccionar</option>
                          </select>
                        </div>
          
    
                    </div>

                    
                    <label class="block text-sm font-medium text-gray-700">
                        Adjuntar multimedia
                    </label>
                    <div class="border-2 border-gray-300 border-dashed rounded-md" id="resources">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6">
                            <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span class="fileinput-button" >Subir archivos</span>
                                {{-- <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple> --}}
                                </label>
                                <p class="pl-1">o arrastra los archivos</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, MP4
                            </p>
                            </div>
                        </div>
                        <div class="mt-1 flex justify-center flex-wrap px-6 pt-5 pb-6" id="previews">

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
        {{-- </div> --}}
    </div>
</x-app-layout>