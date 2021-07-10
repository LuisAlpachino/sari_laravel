<x-app-layout>    
    @push('scripts')
        {{-- <script src="{{asset('js/directions.js')}}"></script> --}}
    @endpush
    <div class="container mx-auto">
      {{-- <script>
        const baseUrl = "<?=Request::root() ?>";
      </script> --}}
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
                <form action="{{route('search.resources')}}" method="POST">
                    @csrf
                      <div class="px-4 py-5 bg-white space-y-6 sm:p-6 relative">
                        
                        <div class="grid grid-cols-12 gap-4">
                          <div class="col-span-6 sm:col-span-5">
                            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                              </span>
                              <input type="text" name="search" id="search" placeholder="Folio o título" autocomplete="search" class="mt-1 px-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                          </div>
        
                          <div class="col-span-6 sm:col-span-1">
                            <button type="submit" class="mt-1 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              Buscar
                            </button>
                          </div>
        
                        </div>
                      </div>
                </form>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700">
                        Multimedia
                    </label>
                    <div class="mt-1">
                        <div class="grid grid-cols-4 items-center container mx-auto my-auto">
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
                <div class="container mx-auto px-4 py-4">
                  @if(method_exists($resources, 'total'))
                    {{ $resources->links('vendor.pagination.tailwind')   }}   
                  @endif
                </div>
            </div>
            
        </div>
            </div>
        {{-- </div> --}}
    </div>
</x-app-layout>