<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\CaseModel;
use App\Model\Audio;

use DB;


class DashboardController extends Controller{
    //Get dashboard page
    public function getDashboard(){
    	//Return dashboard without any data. Data to be loaded by ajax.
        return view('dashboard', [
            'title' => 'Dashboard - RecReporter'
        ]);
    }

    public function getDashboardStats(Request $request){
        $unlistedAudios = Audio::where('readstatus', 0)->count();
        
        $dashActiveFGM = CaseModel::where('tagname', '=', 'FGM')->where('status', '!=', 'Resolved')->count();
        $dashFGMEmergency = CaseModel::where('tagname', '=', 'FGM')->where('status', '!=', 'Resolved')->where('priority', '=', 'High')->count();
        $dashActiveEM = CaseModel::where('tagname', '=', 'Early Childhood Marriage')->where('status', '!=', 'Resolved')->count();
        $dashEMEmergency = CaseModel::where('tagname', '=', 'Early Childhood Marriage')->where('status', '!=', 'Resolved')->where('priority', '=', 'High')->count();
        $dashActiveCA = CaseModel::where('tagname', '=', 'Child Abuse')->where('status', '!=', 'Resolved')->count();
        $dashCAEmergency = CaseModel::where('tagname', '=', 'Child Abuse')->where('status', '!=', 'Resolved')->where('priority', '=', 'High')->count();

        $dashTotalCasesIncept = CaseModel::count();
        $dashTotalCasesYTD = CaseModel::whereYear('created_at', '=', date('Y'))->count();
        if($dashTotalCasesYTD >= 1000)
            $dashTotalCasesYTD = number_format((float)($dashTotalCasesYTD/1000), 1, '.', '')."K";

        if($dashTotalCasesIncept >= 1000)
            $dashTotalCasesIncept = number_format((float)($dashTotalCasesIncept/1000), 1, '.', '')."K";

        $dashResolvedFGM = CaseModel::where('tagname', '=', 'FGM')->where('status', '=', 'Resolved')->count();
        $dashResolvedEM = CaseModel::where('tagname', '=', 'Early Childhood Marriage')->where('status', '=', 'Resolved')->count();
        $dashResolvedCA = CaseModel::where('tagname', '=', 'Child Abuse')->where('status', '=', 'Resolved')->count();
        if($dashResolvedFGM >= 1000)
            $dashResolvedFGM = number_format((float)($dashResolvedFGM/1000), 1, '.', '')."K";
        if($dashResolvedEM >= 1000)
            $dashResolvedEM = number_format((float)($dashResolvedEM/1000), 1, '.', '')."K";
        if($dashResolvedCA >= 1000)
            $dashResolvedCA = number_format((float)($dashResolvedCA/1000), 1, '.', '')."K";

        return array(
            'res' => 1,
            'dashNumRecordings' => $unlistedAudios,
            'dashActiveFGM' => $dashActiveFGM,
            'dashFGMEmergency' => $dashFGMEmergency,
            'dashActiveEM' => $dashActiveEM,
            'dashEMEmergency' => $dashEMEmergency,
            'dashActiveCA' => $dashActiveCA,
            'dashCAEmergency' => $dashCAEmergency,
            'dashTotalCasesIncept' => $dashTotalCasesIncept,
            'dashTotalCasesYTD' => $dashTotalCasesYTD,
            'dashResolvedFGM' => $dashResolvedFGM,
            'dashResolvedEM' => $dashResolvedEM,
            'dashResolvedCA' => $dashResolvedCA
        );
    }

    public function getPieChart(Request $request){
        $fgm = CaseModel::where('tagname', 'FGM')->count();
        $ca = CaseModel::where('tagname', 'Child Abuse')->count();
        $em = CaseModel::where('tagname', 'Early Childhood Marriage')->count();

    	return array(
    		'res' => 1,
    		'message' => 'Success',
    		'fgm' => $fgm,
            'ca' => $ca,
            'em' => $em
        );
    }

    public function getPrevalenceMap(Request $request){
    	$cases = CaseModel::select('firstname', 'lastname', 'description', 'locationname', 'latitude', 'longitude')->get();
    	return array(
    		'res' => 1,
    		'message' => 'Success',
    		'cases' => $cases
    	);

    }

    public function getBarChart(Request $request){
    	$months = array();
        $monthsNum = array();
    	$cases = CaseModel::orderBy('created_at', 'ASC')->get();
    	foreach ($cases as $case) {
    		$month = date('M', strtotime($case->created_at));
    		array_push($months, $month);

            $monthNum = date('m', strtotime($case->created_at));
            array_push($monthsNum, $monthNum);
    	}

    	$months = array_unique($months);
    	$mx = array();

        $monthsNum = array_unique($monthsNum);
        $mxNum = array();
    	
    	$months = array_values($months);
        $monthsNum = array_values($monthsNum);
    	for($i = 0; $i < sizeof($months); $i++){
    		array_push($mx, $months[$i]);
    		
    	}
        for($i = 0; $i < sizeof($monthsNum); $i++){
            array_push($mxNum, $monthsNum[$i]);
            
        }

        $fgmArray = array();
        $caArray = array();
        $emArray = array();

        for ($i = 0; $i < sizeof($mxNum); $i++) { 
            $fgm = CaseModel::where('tagname', 'FGM')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', $mxNum[$i])->count();
            array_push($fgmArray, $fgm);

            $ca = CaseModel::where('tagname', 'Child Abuse')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', $mxNum[$i])->count();
            array_push($caArray, $ca);
            
            $em = CaseModel::where('tagname', 'Early Childhood Marriage')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', $mxNum[$i])->count();
            array_push($emArray, $em);
        }

        //print_r($fgmArray);

        //$fgm = CaseModel::where('tagname', 'FGM')->count();
        //$ca = CaseModel::where('tagname', 'Child Abuse')->count();
        //$em = CaseModel::where('tagname', 'Early Childhood Marriage')->count();

        //print_r($mx);
    	
    	/*$f = array();
    	$fgm = DB::select("SELECT COUNT(id) as ct FROM `cases` WHERE `tagname` = 'FGM' GROUP BY extract(MONTH from created_at)");
    	foreach ($fgm as $fx) {
    		array_push($f, $fx->ct);
    	}

    	$c = array();
    	$cm = DB::select("SELECT extract(MONTH from created_at) as md, COUNT(id) as ct FROM `cases` WHERE `tagname` = 'Early Childhood Marriage' GROUP BY extract(MONTH from created_at)");
    	$monthsNum = $this->monthToNum($mx);
    	foreach ($cm as $m) {
    		for($i = 0; $i < sizeof($monthsNum); $i++){
    			if(($monthsNum[$i] == $m->md) && !empty($m->ct)){
    				//array_push($c, $m->ct);
    				echo $i.' '.$m->md.'<br>';
    				exit();
    			}else{
    				//array_push($c, 0);
    				echo $i." No<br>";
    				exit();
    			}
    		}
    		
    	}
    	

    	$a = array();
    	$ca = DB::select("SELECT COUNT(id) as ct FROM `cases` WHERE `tagname` = 'Early Childhood Marriage' GROUP BY extract(MONTH from created_at)");
    	foreach ($ca as $c) {
    		array_push($a, $c->ct);
    	}*/
    	
    	return array(
    		'res' => 1,
    		'message' => 'Success',
    		'months' => $mx,
    		'fgm' => $fgmArray,
    		'em' =>  $emArray,
    		'ca' =>  $caArray
    	);
    }

    public function monthToNum($months){
    	$r = array();

    	for($i = 0; $i < sizeof($months); $i++){
    		switch ($months[$i]) {
    			case 'Jan':
    				array_push($r, 1);
    				break;
    			case 'Feb':
    				array_push($r, 2);
    				break;
    			case 'Mar':
    				array_push($r, 3);
    				break;
    			case 'Apr':
    				array_push($r, 4);
    				break;
    			case 'May':
    				array_push($r, 5);
    				break;
    			case 'Jun':
    				array_push($r, 6);
    				break;
    			case 'Jul':
    				array_push($r, 7);
    				break;
    			case 'Aug':
    				array_push($r, 8);
    				break;
    			case 'Sep':
    				array_push($r, 9);
    				break;
    			case 'Oct':
    				array_push($r, 10);
    				break;
    			case 'Nov':
    				array_push($r, 11);
    				break;
    			case 'Dec':
    				array_push($r, 12);
    				break;
    			
    		}
    	}
    	return $r;
    }
}
