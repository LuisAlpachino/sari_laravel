<x-app-layout>    
    @push('scripts')
        <script src="{{asset('js/directions.js')}}"></script>
    @endpush
    <div class="container mx-auto">
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
            <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6 relative">
                <h3 class="text-2xl">Reporte</h3>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-5">
                        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" id="title" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$report->title}}" disabled>
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
                        <textarea id="summary" name="summary" rows="14" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" disabled>{{$report->summary}}</textarea>
                    </div>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Cuerpo de noticia
                    </label>
                    <div class="mt-1">
                        <textarea id="content" name="content" rows="20" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" disabled>{{$report->content}}</textarea>
                    </div>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">
                        Tipo de noticia
                    </label>
                    <div class="mt-1">
                        <select name="type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
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
                        <select id="state" name="state" autocomplete="state" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
                            <option value="">Seleccionar</option>
                            @foreach ($states as $state)
                                <option value="{{$state->id}}" @isset($municipality) {{ $state->id == $municipality->state->id ? 'selected' :'' }} @endisset>{{ $state->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="municipality" class="block text-sm font-medium text-gray-700">Municipio</label>
                        <input type="hidden" value="{{$municipality->id ?? ''}}" id="municipalityId" />
                        <select id="municipality" name="municipality" autocomplete="municipality" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
                        <option value="">Seleccionar</option>
                        </select>
                    </div>
        

                </div>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700">
                        Multimedia
                    </label>
                    <div class="mt-1">
                        <div class="grid grid-cols-4 items-center container mx-auto my-auto">
                            @foreach ($report->resources as $resource)
                                <!-- Card 1 -->
                                <div class="col-span-1 lg:m-4 shadow-md hover:shadow-lg hover:bg-gray-100 rounded-lg bg-white my-12 mx-8">
                                <!-- Card Image -->
                                @if(Str::contains($resource->url, 'mp4'))
                                    <img src="{{ asset('images/video.png')}}" alt="" class="overflow-hidden">
                                    <!-- Card Content -->
                                    <div class="p-4">
                                    <h3 class="font-medium text-gray-600 text-lg my-2">Video</h3>
                                @else
                                    <img src="{{ route('getImage.resource', ['filename' => $resource->url])}}" alt=""  class="overflow-hidden">
                                    <!-- Card Content -->
                                    <div class="p-4">
                                    <h3 class="font-medium text-gray-600 text-lg my-2">Imagen</h3>
                                @endif
                                    <div class="mt-5">
                                    <a href="{{ route('download.resource', ['filename' => $resource->url ])}}" class="hover:bg-green-700 rounded-full py-2 px-3 font-semibold hover:text-white bg-green-400 text-green-100">Descargar</a>
                                    </div>
                                </div>
                                </div>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <form action="{{route('save.note')}}" method="POST" class=" bg-gray-100">
                    @csrf

                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 py-2">
                            Nota
                        </label>
                        <input type="hidden" name="report_id" value="{{$report->id}}" />
                        <input type="hidden" name="report_fk_reporter" value="{{$report->fk_users}}" />
                        <div class="mt-1">
                            <textarea id="note" name="note" rows="20" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">@isset($note){{$note->content}}@endisset</textarea>
                        </div>
                    </div>
                    <fieldset>
                        <div class="grid grid-cols gap-6 mt-4 space-y-4">
                          <div class="flex items-center justify-end">
                            <input id="pendiente" name="status" type="radio" value="1" {{ $report->fk_status == 1 ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="pendiente" class="ml-3 block text-sm font-medium text-gray-700">
                              Pendiente
                            </label>
                            <input id="aprobado" name="status" type="radio" value="2" {{ $report->fk_status == 2 ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 ml-4">
                            <label for="aprobado" class="ml-3 block text-sm font-medium text-gray-700">
                              Aprobado
                            </label>
                            <input id="declinado" name="status" type="radio" value="3" {{ $report->fk_status == 3 ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 ml-4">
                            <label for="declinado" class="ml-3 block text-sm font-medium text-gray-700">
                              Declinado
                            </label>
                          </div>
                        </div>
                      </fieldset>

                    <div class="mt-4 px-4 py-3  text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Guargar nota
                        </button>
                    </div>
                </form>

            </div>
            
        </div>
            </div>
        {{-- </div> --}}
    </div>
</x-app-layout>