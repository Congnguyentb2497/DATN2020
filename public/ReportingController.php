<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicalBill;
use App\Template;
use App\History;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Storage;
use File;
use Auth;

class ReportingController extends Controller
{
    protected $medical_bill;
    private $pathUrl;

    public function __construct(MedicalBill $medical_bill)
    {
        $this->pathUrl = $_SERVER['DOCUMENT_ROOT'] . "/../config/url.conf";
        $this->medical_bill = $medical_bill;    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function parseDate($dateString)
    {
        return Carbon::createFromFormat('d/m/Y', $dateString);
    }

    public function index(Request $request)
    {
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        $today = date("Y-m-d");
        if (isset($dateFrom) || isset($dateTo)) 
        {
            $medical_bills = MedicalBill::where('study_status', 3)->orderBy('id','desc');
            $non_edit = MedicalBill::where('study_status', 3)->where('is_edited',0)->orderBy('id','desc');
            $edit = MedicalBill::where('study_status', 3)->where('is_edited',1)->orderBy('id','desc');
        }
        else
        {
            $medical_bills = MedicalBill::where('study_status', 3)->whereDate('schedule_date', $today)->orderBy('id','desc');
            $non_edit = MedicalBill::where('study_status', 3)->where('is_edited',0)->whereDate('schedule_date', $today)->orderBy('id','desc');
            $edit = MedicalBill::where('study_status', 3)->where('is_edited',1)->whereDate('schedule_date', $today)->orderBy('id','desc');
        }
        $limit = $request->limit ? $request->limit : 50;
        $loai_thiet_bi = DB::table('medical_bills')->select('loai_thiet_bi')->groupBy('loai_thiet_bi')->get();
        $templates = Template::all();
        // Nếu là ngày hôm nay
        if(isset($_GET["today"])){
            $medical_bills = $medical_bills->whereDate('schedule_date', $today);
            $non_edit = $non_edit->whereDate('schedule_date', $today);
            $edit = $edit->whereDate('schedule_date', $today);
        }else if(isset($_GET["last_day"])){ // Nếu là 7 ngày trc
            $dt = Carbon::now();
            $from = $dt->subDays(7);
            $medical_bills = $medical_bills->whereDate('schedule_date', '>=', $from)
            ->whereDate('schedule_date', '<=', $today);
            $non_edit = $non_edit->whereDate('schedule_date', '>=', $from)
            ->whereDate('schedule_date', '<=', $today);
            $edit = $edit->whereDate('schedule_date', '>=', $from)
            ->whereDate('schedule_date', '<=', $today);
        }else if(isset($request->date_from) && isset($request->date_to)){ // If có cả ngày từ và đến
            $medical_bills = $medical_bills->whereDate('schedule_date', '>=', $dateFrom)
            ->whereDate('schedule_date', '<=', $dateTo);

            $non_edit = $non_edit->whereDate('schedule_date', '>=', $dateFrom)
            ->whereDate('schedule_date', '<=', $dateTo);
            $edit = $edit->whereDate('schedule_date', '>=', $dateFrom)
            ->whereDate('schedule_date', '<=', $dateTo);
        }else{
            if(isset($request->date_from)){
                $medical_bills = $medical_bills->whereDate('schedule_date', '>=', $dateFrom);

                $non_edit = $non_edit->whereDate('schedule_date', '>=', $dateFrom);
                $edit = $edit->whereDate('schedule_date', '>=', $dateFrom);
            }
            if(isset($request->date_to)){
                $medical_bills = $medical_bills->whereDate('schedule_date', '<=', $dateTo);

                $non_edit = $non_edit->whereDate('schedule_date', '<=', $dateTo);
                $edit = $edit->whereDate('schedule_date', '<=', $dateTo);
            }
        }
        
        if($request->patient_id) {
            $medical_bills = $medical_bills->where('patient_id','like','%'.$request->patient_id.'%');
        }
        if($request->patient_name) {
            // $name = $request->patient_name;
            // $medical_bills = $medical_bills->whereRaw("concat(first_name, ' ', last_name) LIKE ?", ['%' .$name. '%']);
            $medical_bills = $medical_bills->where('first_name','like','%'.$request->patient_name.'%');
        }
        if($request->mota) {
            $medical_bills = $medical_bills->where('mota','like', '%'.$request->mota.'%');
        }
        if($request->access_id) {
            $medical_bills = $medical_bills->where('accession_number','like', '%'.$request->access_id.'%');
        }
        if($request->doctor_name) {
            $medical_bills = $medical_bills->where('ordering_doctor_name', 'like', '%'.$request->doctor_name.'%');
        }
        if($request->ten_thiet_bi){
            $medical_bills = $medical_bills->where('loai_thiet_bi', 'like', '%'.$request->ten_thiet_bi.'%');

            $edit = $edit->where('loai_thiet_bi', 'like', '%'.$request->ten_thiet_bi.'%');
            $non_edit = $non_edit->where('loai_thiet_bi', 'like', '%'.$request->ten_thiet_bi.'%');
        }
        $medical_bills = $medical_bills->paginate($limit)->appends([
            'patient_id' => $request->patient_id,
            'patient_name' => $request->patient_name,
            'access_id' => $request->access_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'ten_thiet_bi' => $request->ten_thiet_bi
        ]);

        $file = fopen($this->pathUrl, "r") or die("Unable to open file!");
        $url2 = fgets($file);
        fclose($file);
        return view('users.reporting', compact('medical_bills','templates','loai_thiet_bi', 'url2', 'non_edit', 'edit'));
    }
}
