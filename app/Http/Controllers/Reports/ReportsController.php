<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\CaseModel;

class ReportsController extends Controller{
	public function getCustomReports(){
		$report = CaseModel::select('firstname', 'lastname', 'phone', 'created_at', 'locationname', 'tagname', 'status')->get();

		return view('reports.custom', [
			'title' => 'Custom Reports - Rec Reporter',
			'report' => $report
		]);
	}

	public function generateCustomizedReport(Request $request){
		$start = date('Y-m-d H:i:s', strtotime($_GET['start'].' 00:00:00'));
		$end = date('Y-m-d H:i:s', strtotime($_GET['end'].' 23:59:59'));
		$type = $_GET['type'];
		
		$report = CaseModel::select(
			'firstname', 'lastname', 'phone', 'created_at', 'locationname', 'tagname', 'status'
		)->whereBetween('created_at', [$start, $end])->get();

		if($type == 'Open Cases'){
			$report = CaseModel::select(
				'firstname', 'lastname', 'phone', 'created_at', 'locationname', 'tagname', 'status'
			)->whereIn('status', ['Received', 'Progress'])->whereBetween('created_at', [$start, $end])->get();
		}else if($type == 'Resolved Cases'){
			$report = CaseModel::select(
				'firstname', 'lastname', 'phone', 'created_at', 'locationname', 'tagname', 'status'
			)->where('status', 'Resolved')->whereBetween('created_at', [$start, $end])->get();
		}

		return view('reports.custom', [
			'title' => 'Custom Reports - Rec Reporter',
			'report' => $report,
			'start' => date('Y-m-d', strtotime($start)),
			'end' => date('Y-m-d', strtotime($end))
		]);
	}
}
