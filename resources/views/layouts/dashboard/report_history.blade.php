<x-app-layout>
    
    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          @include('includes.message')
          @include('includes.error')
          <form action="{{route('search.reports')}}" method="POST" id="report" >
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6 relative">
                
                <div class="grid grid-cols-12 gap-4">
                  <div class="col-span-6 sm:col-span-5">
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                      <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                      </span>
                      {{-- <input type="text" placeholder="Placeholder" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/> --}}
                      <input type="text" name="search" id="search" placeholder="Folio o título" autocomplete="search" class="mt-1 px-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    {{-- <label for="title" class="block text-sm font-medium text-gray-700">Buscar</label> --}}
                  </div>

                  <div class="col-span-6 sm:col-span-1">
                    <button type="submit" class="mt-1 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Buscar
                    </button>
                  </div>

                </div>
              </div>
            </div>
        </form>



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
                        {{ $report->title}}
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
                      <a href="{{route('delete.report', $report->id)}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Borrar
                      </a>
                    </td>
                </tr>
  
              <!-- More people... -->
              @endforeach
            </tbody>
          </table>
          <div class="container mx-auto px-4 py-4">
            {{ $reports->links('vendor.pagination.tailwind') }}

          </div>
          
        </div>
      </div>
    </div>
  </div>
  
</x-app-layout>