<div class="
            container
            bg-black
            w-64
            h-full
            fixed
            m-0 p-4
        ">
    <ul class="text-white font-bold uppercase ">
        <li class="mt-6" >
            <x-nav-link class="cursor-pointer" :href="route('dashboard')">
                <x-application-logo></x-application-logo>
            </x-nav-link>
        </li>
        <li class="mt-6 py-1  cursor-pointer">
            <x-nav-link  :href="route('create.report')" :active="request()->routeIs('create.report')">
                <i class="fa fa-file-text fa-lg mr-1 " aria-hidden="true"></i>
                {{ __('Nuevo reporte') }}
            </x-nav-link>
        </li>
        <li class="mt-6 py-1 cursor-pointer">
            <x-nav-link  :href="route('reports.editor')" :active="request()->routeIs('reports.editor')">
                <i class="fa fa-files fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Reportes') }}
            </x-nav-link>
        </li>
        <li class="mt-6 py-1 cursor-pointer">
            <x-nav-link  :href="route('notes')" :active="request()->routeIs('notes')">
                <i class="fa fa-commenting-o fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Notas') }}
            </x-nav-link>
        </li>
        <li class="mt-6 py-1 cursor-pointer">
            <x-nav-link  :href="route('medias')" :active="request()->routeIs('medias')">
                <i class="fa fa-play-circle fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Multimedia') }}
            </x-nav-link>
        </li>
        <li class="mt-6 py-1 cursor-pointer">
            <x-nav-link  :href="route('history.reports')" :active="request()->routeIs('history.reports')">
                <i class="fa fa-history fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Historial') }}
            </x-nav-link>
        </li>
        @can('all')
        <li class="mt-6 py-1 cursor-pointer">
            <x-nav-link  :href="route('users')" :active="request()->routeIs('users')">
                <i class="fa fa-users fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Users') }}
            </x-nav-link>
        </li>
        @endcan
        <!-- <li class="mt-48 py-1 cursor-pointer border-t-4">
            <x-nav-link  :href="route('configurations')" :active="request()->routeIs('configurations')">
                <i class="fa fa-cogs fa-lg mr-1" aria-hidden="true"></i>
                {{ __('Configuración') }}
            </x-nav-link>
        </li> -->

        </a>
    </ul>
</div>
