<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Report;
use App\Models\State;
use App\Models\NewsType;
use App\Models\Municipality;
use App\Models\Note;

class ReportController extends Controller
{
    public function create(Request $request) {

        $states = State::all();
        $news_types = NewsType::all();
        
        $last_report = Report::where('id', '>', 0)->where('fk_users', $request->user()->id)->orderBy('id', 'desc')->first();
        // $last_report = Report::where('id', '>', 0)->where('fk_users', $request->user()->id)->orderBy('created_at', 'desc')->first();
        $report;
        if($last_report && $last_report->fk_news_types == null && $last_report->fk_municipalities == null ) {
            $report = $last_report;
        } else {
            $report = Report::create([
                'title' => '',
                'summary' => '',
                'content' => '',
                'fk_status' => 1,
                'fk_users' => $request->user()->id,
            ]);
        }

        return view('layouts.dashboard.create', [
            'states' => $states,
            'news_types' => $news_types,
            'report' => $report
        ]);
    }

    public function save(Request $request) {

        // dd($request);

        $request->validate([
            'report_id' => 'required|integer',
            'title' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'type' => 'required|integer',
            'municipality' => 'required|integer'
        ]);

        $id = $request->report_id;

        $report = Report::find($id);
        $report->title = $request->title;
        $report->summary = $request->summary;
        $report->content = $request->content;
        $report->fk_news_types = $request->type;
        $report->fk_municipalities = $request->municipality;
        $report->fk_status = 1;
        $report->save();

        return redirect()->route('history.reports')->with(['message' => 'Repororte guardado con éxito.']);

        
    }

    public function edit($id) {
        $report = Report::find($id);
        $municipality = Municipality::find($report->fk_municipalities);
        
        $states = State::all();
        $news_types = NewsType::all();

        $edit = true;

        return view('layouts.dashboard.create', [
            'states' => $states,
            'news_types' => $news_types,
            'report' => $report,
            'edit' => $edit,
            'municipality' => $municipality
        ]);


    }

    public function delete($id) {
        $report = Report::find($id);
        $report->delete();

        return redirect()->route('history.reports')->with(['message' => 'Reporte borrado.']);


    }

    public function municipalities($state_id) {
        $state = State::find($state_id);
        $municipalities = $state->municipalities()->get();

        return response()->json(['municipalities' => $municipalities]);
    }

    public function history(Request $request) {

        $reports = Report::where('fk_users', $request->user()->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('layouts.dashboard.report_history', [
            'reports' => $reports
        ]);
    }

    public function search(Request $request) {

        // dd($request);
        $request->validate([
            'search' => 'required|string',
        ]);

        $search = $request->search;
        $reports = Report::where('fk_users', $request->user()->id)->where('id', 'like', '%'.$search.'%')->orWhere('title', 'like', '%'.$search.'%')->paginate(15);
    
        return view('layouts.dashboard.report_history', [
            'reports' => $reports
        ]);
    }

    public function allReportsEditor() {

        $reports = Report::where('id', '>=', 1)->orderBy('created_at', 'desc')->paginate(15);
        
        return view('layouts.dashboard.reports', [
            'reports' => $reports
        ]);
    }

    public function detail($id) {
        $report = Report::find($id);

        $note = Note::where('fk_reports', $id)->where('fk_users', \Auth::user()->id)->first();
        
        if($report != null && $report != '') {

            $municipality = Municipality::find($report->fk_municipalities);
            
            $states = State::all();
            $news_types = NewsType::all();
    
            return view('layouts.dashboard.detail', [
                'states' => $states,
                'news_types' => $news_types,
                'report' => $report,
                'municipality' => $municipality,
                'note' => $note
            ]);
        } else {
            return redirect()->route('reports.editor')->with(['error' => 'El reporte no existe']);
        }

    }

    public function searchEditor(Request $request) {

        // dd($request);
        $request->validate([
            'search' => 'required|string',
        ]);

        $search = $request->search;
        $reports = Report::where('id', 'like', '%'.$search.'%')->orWhere('title', 'like', '%'.$search.'%')->paginate(15);
    
        return view('layouts.dashboard.reports', [
            'reports' => $reports
        ]);
    }

    public function reportMonth($year, $month) {

        // $reports = Report::factory()->count(200)->create();
        // die();

        $list_reports = [];
        if($year > 0 && ($month > 0 && $month <= 12)) {
            
            $date = Carbon::create($year, $month);
            $next_day =  Carbon::create($year, $month)->addDay();
            
            // $now = Carbon::today('UTC');
            // $next_day = $date->addDay();
            
    
            
            // $reports = Report::where('created_at', '>', $date)->where('created_at', '<', $next_day)->get();
    
            do {

                $reportsApproved = Report::where('created_at', '>', $date)->where('created_at', '<', $next_day)->where('fk_status', 2)->count();
                $reportsRejected = Report::where('created_at', '>', $date)->where('created_at', '<', $next_day)->where('fk_status', 3)->count();
                $reportsPending = Report::where('created_at', '>', $date)->where('created_at', '<', $next_day)->where('fk_status', 1)->count();
                
                $list_reports[] = [$date->day, $reportsApproved, $reportsRejected, $reportsPending];
    
                $date->addDay();
                $next_day->addDay();
            }
            while($next_day->day != 2);
        }


        return response()->json(['reports' => $list_reports]);

    }
    public function reportMonthPie($year, $month) {

        $list_reports = [];
        if($year > 0 && ($month > 0 && $month <= 12)) {
            
            $date = Carbon::create($year, $month);
            $next_month =  Carbon::create($year, $month)->addMonth();
            
            $reportsApproved = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 2)->count();
            $reportsRejected = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 3)->count();
            $reportsPending = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 1)->count();
            
            
            $list_reports[] = ['Reportes aprobados', $reportsApproved];
            $list_reports[] = ['Reportes rechazados', $reportsRejected];
            $list_reports[] = ['Reportes pendientes', $reportsPending];
        }


        return response()->json(['reports' => $list_reports]);

    }

    public function reportYear($year) {

        $list_reports = [];
        if($year > 0 ) {
            
            $date = Carbon::create($year, 1);
            $next_month =  Carbon::create($year, 1)->addMonth();
            for($i = 0; $i < 12; $i++) {
                $reportsApproved = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 2)->count();
                $reportsRejected = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 3)->count();
                $reportsPending = Report::where('created_at', '>=', $date)->where('created_at', '<', $next_month)->where('fk_status', 1)->count();

                switch($date->month) {
                    case 1:
                        $list_reports[] = ['Ene', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 2:
                        $list_reports[] = ['Feb', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 3:
                        $list_reports[] = ['Mar', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 4:
                        $list_reports[] = ['Abr', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 5:
                        $list_reports[] = ['May', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 6:
                        $list_reports[] = ['Jun', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 7:
                        $list_reports[] = ['Jul', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 8:
                        $list_reports[] = ['Ago', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 9:
                        $list_reports[] = ['Sep', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 10:
                        $list_reports[] = ['Oct', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 11:
                        $list_reports[] = ['Nov', $reportsApproved, $reportsRejected, $reportsPending];
                    break;
                    case 12:
                        $list_reports[] = ['Dic', $reportsApproved, $reportsRejected, $reportsPending];
                    break;

                }
                // $list_reports[] = [$date->month, $reportsApproved, $reportsRejected, $reportsPending];
    
                $date->addMonth();
                $next_month->addMonth();
            }

        }


        return response()->json(['reports' => $list_reports]);

    }




}
