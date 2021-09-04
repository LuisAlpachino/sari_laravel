<x-app-layout>    
    <div class="container mx-auto">
        <script>
            const baseUrl = "<?=Request::root() ?>";
            // const url = <?=Request::root() ?>
        </script>

            @include('includes.message')
            @include('includes.error')
            <div class="grid grid-cols-2 gap-4">

                <div class="lg:m-4 shadow-md hover:shadow-lg rounded-lg bg-white my-12 mx-8">
                    <div class="p-4 sm:col-span-2 md:col-span-1">
                        <h3 class="font-medium text-gray-600 text-lg my-2">Últimos reportes</h3>
                        <div class="container overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       Folio
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Título
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Reportero
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                      <span class="sr-only">Editar</span>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($reports as $report)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $report->id}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ Str::limit($report->title, 10)}}
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $report->title}}
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($report->fk_status == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-300 text-yellow-800">
                                                    Pendiente
                                                </span>
                                            @elseif($report->fk_status == 2)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                                    Aprobado
                                                </span>
                                            @elseif($report->fk_status == 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                                    Declinado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                          <a href="{{route('edit.report', $report->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                        </td>
                                    </tr>
                      
                                  <!-- More people... -->
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
                <div class="lg:m-4 shadow-md hover:shadow-lg rounded-lg bg-white my-12 mx-8 ">
                    <div class="p-4 sm:col-span-2 md:col-span-1">
                        <h3 class="font-medium text-gray-600 text-lg my-2">Últimos multimedia</h3>
                        <div class="grid grid-cols-1 2xl:grid-cols-3 xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-1">
                            @foreach ($resources as $resource)
                                <!-- Card 1 -->
                                <div class="col-span-1 lg:m-4 shadow-md hover:shadow-lg hover:bg-gray-100 rounded-lg bg-white my-12 mx-8">
                                <!-- Card Image -->
                                    @if(Str::contains($resource->url, 'mp4'))
                                        <img src="{{ asset('images/video.png')}}" alt="" class="w-48 h-40 overflow-hidden">
                                    <!-- Card Content -->
                                        <div class="p-4">
                                        <h3 class="font-medium text-gray-600 text-lg my-2">Video</h3>
                                    @else
                                        <img src="{{ route('getImage.resource', ['filename' => $resource->url])}}" alt=""  class="w-48 h-40 overflow-hidden">
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
                    <!-- Card Content -->
                </div>
            </div>

            @can('all')
            <div class="grid grid-cols-1 gap-4">
                <div class="lg:m-4 shadow-md hover:shadow-lg rounded-lg bg-white my-12 mx-8 grid grid-cols-3">
                    <div class="h-96 md:col-span-2 sm:col-span-3" id="chart_month"></div>
                    <!--Div that will hold the dashboard-->
                    {{-- <div id="dashboard_month">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter_div"></div>
                        <div id="chart_div"></div>
                    </div> --}}
                    <!-- Card Content -->
                    <div class="p-4 sm:col-span-3 md:col-span-1">
                        <h3 class="font-medium text-gray-600 text-lg my-2">Reportes del mes</h3>
                        <select class="mr-5" name="month" id="month">
                            <option {{$date->month == 1 ? 'selected' : ''}} value="1">Enero</option>
                            <option {{$date->month == 2 ? 'selected' : ''}} value="2">Febrero</option>
                            <option {{$date->month == 3 ? 'selected' : ''}} value="3">Marzo</option>
                            <option {{$date->month == 4 ? 'selected' : ''}} value="4">Abril</option>
                            <option {{$date->month == 5 ? 'selected' : ''}} value="5">Mayo</option>
                            <option {{$date->month == 6 ? 'selected' : ''}} value="6">Junio</option>
                            <option {{$date->month == 7 ? 'selected' : ''}} value="7">Julio</option>
                            <option {{$date->month == 8 ? 'selected' : ''}} value="8">Agosto</option>
                            <option {{$date->month == 9 ? 'selected' : ''}} value="9">Septiembre</option>
                            <option {{$date->month == 10 ? 'selected' : ''}} value="10">Octubre</option>
                            <option {{$date->month == 11 ? 'selected' : ''}} value="11">Noviembre</option>
                            <option {{$date->month == 12 ? 'selected' : ''}} value="12">Diciembre</option>
                        </select>
                        <select name="year" id="yearMonth">
                        @for ($i = $date->year; $i >= 2020; $i--)
                            <option {{$i == $date->year ? 'selected' : ''}}  value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        <p class="text-justify mt-5">Total de reportes: <strong id="totalMonth"></strong></p>          
                        <p class="text-justify">Reportes aprobados: <strong id="approvedMonth"></strong></p>          
                        <p class="text-justify">Reportes Rechazados: <strong id="rejectedMonth"></strong></p>          
                        <p class="text-justify">Reportes pendientes: <strong id="pendingMonth"></strong></p>          
                    </div>
                </div>
                <div class="lg:m-4 shadow-md hover:shadow-lg rounded-lg bg-white my-12 mx-8 grid grid-cols-4">
                    <div class="h-96 md:col-span-3 sm:col-span-4" id="chart_year"></div>
                    <!-- Card Content -->
                    <div class="p-4 sm:col-span-4 md:col-span-1">
                        <h3 class="font-medium text-gray-600 text-lg my-2">Reportes del año</h3>
                        <select name="year" id="year">
                        @for ($i = $date->year; $i >= 2020; $i--)
                            <option {{$i == $date->year ? 'selected' : ''}}  value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        <p class="text-justify mt-5">Total de reportes: <strong id="totalYear"></strong></p>          
                        <p class="text-justify">Reportes aprobados: <strong id="approvedYear"></strong></p>          
                        <p class="text-justify">Reportes Rechazados: <strong id="rejectedYear"></strong></p>          
                        <p class="text-justify">Reportes pendientes: <strong id="pendingYear"></strong></p>       
                    </div>
                </div>
                {{-- <div>{{\Request::root()}}</div>
                <div>4</div> --}}
                
            </div>
            @endcan
           
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="{{asset('js/chart-month.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/chart-year.js')}}" ></script>
    @endpush
</x-app-layout>