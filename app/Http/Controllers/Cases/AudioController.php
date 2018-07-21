<?php

namespace App\Http\Controllers\Cases;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Model\Audio;
use App\Model\Tag;
use App\Model\Priority;
use App\Model\CaseModel;

class AudioController extends Controller{
    //Get all Unlistened to audios
    public function getWaitingCases(){
        $audios = Audio::with('device')->where('readstatus', 0)->get();
        $tags = Tag::get();
        $priorities = Priority::get();

        return view('cases.waiting', [
            'title' => 'Waiting Cases - Rec Reporter',
            'audios' => $audios,
            'tags' => $tags,
            'priorities' => $priorities
        ]);
    }

    //Discard a recording
    public function discardRecording(Request $request){
        if (Audio::where('id', $request->input('audioId'))->delete()) {
            return array(
                'res' => 1,
                'message' => 'Recording discarded successfully'
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error discarding recording. Refresh browser and try again'
            );
        }
        
    }

    //Create case from audio
    public function createCaseFromAudio(Request $request){
        $case = new CaseModel();
        $case->firstname = $request->input('fName');
        $case->lastname = $request->input('lName');
        $case->phone = $request->input('callerPhone');
        $case->user_id = Auth::user()->id;
        $case->calltime = $request->input('calltime');
        $case->locationname = $request->input('locationName');
        $case->latitude = $request->input('latitude');
        $case->longitude = $request->input('longitude');
        $case->radius = $request->input('radius');
        $case->description = $request->input('description');
        $case->tagname = $request->input('tag');
        $case->priority = $request->input('priority');
        $case->recording_gsm_id = $request->input('audioId');
        $case->case_uid = hash("SHA512", $this->randomString(20));
        $case->save();

        if ($case->id > 0) {
            //Attach a tag
            $caseTag = Tag::where('name', $request->input('tag'))->first();
            $case->tags()->attach($caseTag);

            //Change audio readstatus and readdt
            Audio::where('id', $request->input('audioId'))->update([
                'readstatus' => 1,
                'readdt' => date('Y-m-d H:i:s')
            ]);

            //Return success message and the case.
            return array(
                'res' => 1,
                'message' => 'Case recorded successfully',
                'case' => $case
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error recording case. Refersh browser and try again'
            );
        }
        
    }

    //Get audio date and caller phone
    public function getAudioDateAndPhone(Request $request){
        $date = Audio::where('id', $request->input('audioId'))->value('sentdt');
        $recordingName = Audio::where('id', $request->input('audioId'))->value('recordingname');
        $name = explode('.', $recordingName);
        $filePath = "http://device-sgf.recreporter.com/upload/recordings/".$name[0].".mp3";
        $phone = $this->getPhoneFromAudio($request->input('audioId'));
        if (!empty($date)) {
            $res = date( 'Y-m-d', strtotime($date));

            return array(
                'res' => 1,
                'audioDate' => $res,
                'callerPhone' => $phone,
                'filePath' => $filePath,
                'message' => 'Date and phone fetched successfully'
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error fetching audio date'
            );
        }
    }

    //Get phone number from recording
    public function getPhoneFromAudio($audioId){
        $recordingName = Audio::where('id', $audioId)->value('recordingname');
        $recordingName = explode('-', $recordingName);
        $phone = $recordingName[7];

        //If phone number starts with underscore (_), remove the underscore.
        if(substr($phone, 0, 1) == '_')
            $phone = substr($phone, 1);

        return $phone;
    }

    //Generate random string
    public function randomString($len){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $result = "";
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        $result .= date('Y-m-d H:i:s');
        return $result;
    }
}
