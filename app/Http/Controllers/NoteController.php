<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\Note;
use App\Models\Report;

class NoteController extends Controller
{
    public function save(Request $request) {

        $request->validate([
            'note' => 'nullable|string',
            'report_id' => 'required|integer',
            'report_fk_reporter' => 'required|integer',
            'status' => 'required|integer'
        ]);

        // dd($request);

        $report = Report::find($request->report_id);
        

        if($report != null && $report != '') {
            $report->fk_status = $request->status;
            $report->save();

            // if($request->note == null ) {
                
            // }

            $note = Note::updateOrCreate(
                ['fk_reports' => $report->id , 'fk_users' => $request->user()->id, 'fk_reporter' => $request->report_fk_reporter],
                ['content' => $request->note, 'fk_reporter' => $request->report_fk_reporter]
            );



        }

        return redirect()->route('reports.editor')->with(['message' => 'Nota guardada']);


        
    }

    public function notes(Request $request) {

        // $notes = Note::where('content', '!=', null)->get();

        // $reports_id;

        // foreach($notes as $note) {
        //     $reports_id[]
        // }

        // $reports = DB::table('reports')
        //     ->where('fk_users', '=', $request->user()->id)
        //     ->join('notes', 'reports.id', '=', 'notes.fk_reports')
        //     ->select('reports.*')
        //     ->get();

        // $reports = Report::where('fk_users', $request->user()->id)->where()->orderBy('created_at', 'DESC')->paginate(15);

        // dd($reports);

        $notes = Note::where('content', '!=', null)->where('fk_reporter', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(15);
        // $notes->load('report');

        // foreach($notes as $note) {
        //     dd($note->report);
        // }
        // // dd($notes);

        // $reports = $reports->reject(function ($report) {
        //     return $report->id < 0;
        // });

        // dd($reports);

        return view('layouts.dashboard.notes', [
            'notes' => $notes
        ]);
    }

    public function detail($id) {
        $report = Report::find($id);

        $notes = Note::where('fk_reports', $report->id)->where('fk_reporter', \Auth::user()->id)->get();
        
        if($report != null && $report != '') {

            return view('layouts.dashboard.note-detail', [
                'report' => $report,
                'notes' => $notes
            ]);
        } else {
            return redirect()->route('notes')->with(['error' => 'No existe nota para este reporte']);
        }

    }

    public function search(Request $request) {

        // dd($request);
        $request->validate([
            'search' => 'required|string',
        ]);

        $search = $request->search;
        $reports = Report::where('fk_users', $request->user()->id)->where('id', 'like', '%'.$search.'%')->orWhere('title', 'like', '%'.$search.'%')->get();
        
        $notes_keys = [];

        foreach($reports as $report) {
            foreach($report->notes as $note)
            $notes_keys[] = $note->id;
        }

        // dd($notes_keys);

        $notes = Note::find($notes_keys);

        return view('layouts.dashboard.notes', [
            'notes' => $notes
        ]);
    }
}
