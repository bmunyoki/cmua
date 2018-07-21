<?php

namespace App\Http\Controllers\Cases;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Model\CaseModel;
use App\Model\Audio;
use App\Model\Device;
use App\Model\CaseProgress;

class CaseController extends Controller{
    //Get received cases - not been moved to progress
    public function getReceivedCases(){
        $cases = CaseModel::where('status', 'Received')->orderBy('id', 'DESC')->get();

        return view('cases.received-cases', [
            'title' => 'Received Cases - Rec Reporter',
            'cases' => $cases
        ]);
    }

    //Close a case
    public function closeACase(Request $request){
        $case = CaseModel::where('id', $request->input('caseId'))->first();

        if (CaseModel::where('id', $request->input('caseId'))->update([
            'status' => 'Resolved',
            'closedBy' => Auth::user()->firstname.' '.Auth::user()->lastname,
            'closedate' => date('Y-m-d')
        ])) {
            return array(
                'res' => 1,
                'message' => 'Case { '.$case->firstname.' '.$case->lastname.' } has been resolved.'
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error closing case. Refresh browser and try again'
            );
        }
    }

    //Get cases in process 
    public function getCasesInProgress(){
        $cases = CaseModel::where('status', 'Progress')->orderBy('id', 'DESC')->get();

        return view('cases.progress', [
            'title' => 'Cases in Progress - Rec Reporter',
            'cases' => $cases
        ]);
    }

    //Get resolved cases 
    public function getResolvedCases(){
        $cases = CaseModel::where('status', 'Resolved')->orderBy('id', 'DESC')->paginate(20);

        return view('cases.resolved', [
            'title' => 'Resolved Cases - Rec Reporter',
            'cases' => $cases
        ]);
    }

    //Create a case notes
    public function createCaseNotes(Request $request){
        $uid = CaseModel::where('id', $request->input('caseId'))->value('case_uid');

        $notes = new CaseProgress();
        $notes->user_id = Auth::user()->id;
        $notes->case_id = $request->input('caseId');
        $notes->details = $request->input('notes');
        $notes->save();

        if ($notes->id > 0) {
            //Update case progress -> move to in Progress
            CaseModel::where('id', $request->input('caseId'))->update([
                'status' => 'Progress'
            ]);
            
            //Return success message and the created note
            return array(
                'res' => 1,
                'redirect' => '/cases/single/progress/'.$uid,
                'message' => 'Case progress has been updated. Redirecting ... ',
                'notes' => $notes
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error updating case progress. Refresh browser and try again'
            );
        }
        
    }

    //Close case with closure notes
    public function closeCaseWithNotes(Request $request){
        $uid = CaseModel::where('id', $request->input('caseId'))->value('case_uid');

        $notes = new CaseProgress();
        $notes->user_id = Auth::user()->id;
        $notes->case_id = $request->input('caseId');
        $notes->details = $request->input('notes');
        $notes->save();

        if ($notes->id > 0) {
            //Update case progress -> move to in Progress
            CaseModel::where('id', $request->input('caseId'))->update([
                'status' => 'Resolved',
                'closedBy' => Auth::user()->firstname.' '.Auth::user()->lastname,
                'closedate' => date('Y-m-d')
            ]);
            
            //Return success message and the created note
            return array(
                'res' => 1,
                'redirect' => '/cases/resolved',
                'message' => 'Case and been closed and closure notes recorded.',
                'notes' => $notes
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error closing case. Refresh browser and try again'
            );
        }
        
    }

    //Get a single case progress page
    public function getASingleCaseProgress(Request $request){
        $uid = Request()->segment(4);
        $caseId = CaseModel::where('case_uid', $uid)->value('id'); 
        $progress = CaseProgress::where('case_id', $caseId)->get();
        $case = CaseModel::where('case_uid', $uid)->first();

        return view('cases.single-case-progress', [
            'title' => 'Single Case Progress - Rec Reporter',
            'progress' => $progress,
            'case' => $case
        ]);
    }

    //Get a single case
    public function getASingleCase(Request $request){
        $uid = Request()->segment(3);
        
        $case = CaseModel::where('case_uid', $uid)->first();

        $recordingId = CaseModel::where('case_uid', $uid)->value('recording_gsm_id');
        $recordingName = Audio::where('id', $recordingId)->value('recordingname');
        $name = explode('.', $recordingName);
        $filePath = "http://device-sgf.recreporter.com/upload/recordings/".$name[0].".mp3";

        return view('cases.single', [
            'title' => 'Single Case - Rec Reporter',
            'case' => $case,
            'filePath' => $filePath
        ]);
    }
}
