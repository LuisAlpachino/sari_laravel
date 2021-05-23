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
                
                @foreach ($notes as $note)
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700 py-2">
                        Nota
                    </label>
                    <label for="note" class="text-sm font-medium text-gray-700 p-2 bg-gray-200">
                        Editor: {{ $note->editor->name . ' ' .$note->editor->last_name}}
                    </label>
                    <input type="hidden" name="report_id" value="{{$report->id}}" />
                    <input type="hidden" name="report_fk_reporter" value="{{$report->fk_users}}" />
                    <div class="mt-4">
                        <textarea id="note" name="note" rows="20" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" disabled>@isset($note){{$note->content}}@endisset</textarea>
                    </div>
                </div>
                
                @endforeach

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

                <div class="mt-4 px-4 py-3  text-right sm:px-6">
                    <a href="{{route('edit.report', ['id' => $report->id])}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Editar reporte
                    </a>
                </div>
            </div>
                
        </div>
            </div>
        {{-- </div> --}}
    </div>
</x-app-layout>