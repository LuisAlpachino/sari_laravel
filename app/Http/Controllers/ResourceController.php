<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Resource;
use App\Models\Report;

class ResourceController extends Controller
{
    public function save(Request $request) {
        // dd($request);

        $request->validate([
            'resource' => 'required|mimes:jpg,jpeg,png,mp4|max:102400',
            'report_id' => 'required|integer'
        ]);

        // Recoger los datos de la petición
        $resource = $request->file('resource');

        // Guardar los documentos en la base de datos
        $resource_storage = \Storage::putFile('resources', $resource);
        $resource_name = Str::after($resource_storage, 'resources/');
         
        $user = $request->user();
        Resource::Create([
            'fk_reports' => $request->report_id,
            'url'        => $resource_name
        ]);
    
        return response()->json([
            'message' => 'El recurso se subio correctamente'], 201);

    }

    public function getResourcesByReportId ($report_id) {
        $resources = Resource::where('fk_reports', $report_id)->get();

        return response()->json(['resources' => $resources], 200);
    }

    public function getResources() {
        $resources = Resource::where('id', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);

        return view('layouts.dashboard.media', [
            'resources' => $resources
        ]);
    }

    public function search(Request $request) {
        $request->validate([
            'search' => 'required|string',
        ]);

        $search = $request->search;
        $reports = Report::where('id', 'like', '%'.$search.'%')->orWhere('title', 'like', '%'.$search.'%')->get();

        $resources_keys = [];

        foreach($reports as $report) {
            foreach($report->resources as $resource) {
                $resources_keys[] = $resource->id;
            }
        }

        $resources = Resource::find($resources_keys);
    
        return view('layouts.dashboard.media', [
            'resources' => $resources
        ]);
    }

    public function getImage($filename) {
        $file = Storage::disk('resources')->get($filename);
        return new Response($file, 200);
    }

    public function downloadFile($filename) {
        return Storage::disk('resources')->download($filename);
    }

    public function deleteFile($filename) {
        Storage::disk('resources')->delete($filename);
        $resource = Resource::where('url', $filename);
        $resource->delete();

        return response()->json(['message' => 'El archivo se ha borrado correctamente'], 200);
    }
}
