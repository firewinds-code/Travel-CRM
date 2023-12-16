<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use App\Models\TravelDetails;
use Illuminate\Support\Facades\Auth;
use App\Helpers\DropdownHelper;
use App\Models\ProcessOption;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function view()
    {
        try {
            $places = DropdownHelper::getPlaces();
            $process = DropdownHelper::getProcess();
            return view('portal.view', compact('places', 'process'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function report(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::join('travel_details', 'users.emp_id', 'travel_details.employee_id')
                    ->select('users.name', 'users.emp_id', 'users.usertype', 'travel_details.*')
                    ->where(function ($query) {
                        $query->where('users.name', [Auth::User()->name]);
                    })
                    ->get();
                return DataTables::of($data)
                    ->make(true);
            }
            return view('portal.report');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function details(Request $request)
    {
        try {

            if ($request->departure_city == $request->destination_city) {
                return redirect()->back()->with('error', 'The departure city and destination city must be different.');
            }
            $user = new TravelDetails;
            $user->vehicle = $request->vehicle;
            $user->employee_id = Auth::user()->emp_id;
            $user->departure_city = $request->departure_city;
            $user->destination_city = $request->destination_city;
            $user->reservation_date_time = $request->reservation_date_time;
            $user->reason = $request->reason;
            $user->process =  isset($request->other_process) ? $request->other_process : $request->process;
            if (isset($request->other_process)) {
                $value = $request->other_process;
                ProcessOption::firstOrCreate(['process' => $value]);
            }
            $user->accomodation = $request->accomodation;
            $user->days_required = $request->days_required;
            $user->advance_required = $request->advance_required;
            $user->amount = $request->amount;
            $user->created_by = Auth::user()->emp_id;
            $user->updated_by = Auth::user()->emp_id;
            $user->save();
            return redirect('portal/view')->with('success', 'Details Added Successfully');
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    public function editRequests(Request $request)
    {
        try {

            $places = DropdownHelper::getPlaces();
            $process = DropdownHelper::getProcess();
            $id = $request->id;
            $query = DB::table('users')
                ->join('travel_details', 'users.emp_id', '=', 'travel_details.employee_id')
                ->select('users.name', 'users.emp_id', 'users.usertype', 'travel_details.*')
                ->where('travel_details.id', $id)
                ->first();
            $html = view('portal.edit', compact('query', 'places', 'process'))->render();
            return response()->json(['html' => $html, 'success' => true]);
        } catch (Exception $ex) {
            // dd($ex->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function table(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::join('travel_details', 'users.emp_id', 'travel_details.employee_id')
                    ->select('users.name', 'users.emp_id', 'users.usertype', 'travel_details.*')
                    ->where('users.name', [Auth::User()->name])
                    ->where(function ($query) {
                        $query->whereNotIn('travel_details.approval_status', ['Approved', 'Rejected'])
                              ->orWhereNull('travel_details.approval_status');
                    })
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        $btn = view('ajax.btn', compact('user'))->render();
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('portal.table');
        } catch (Exception $e) {
            // dd($e);
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function update(Request $request)
    {

        try {


            if ($request->isMethod('post') && $request->departure_city == $request->destination_city) {
                return redirect()->back()->with('error', 'The departure city and destination city must be different.');
            }
            $user = TravelDetails::find($request->travel_id);
            // dd($user);
            $user->vehicle = $request->vehicle;
            $user->departure_city = $request->departure_city;
            $user->destination_city = $request->destination_city;
            $user->reservation_date_time = $request->reservation_date_time;
            $user->reason = $request->reason;
            $user->process = $request->process;
            $user->accomodation = $request->accomodation;
            $user->days_required = $request->days_required;
            $user->advance_required = $request->advance_required;
            $user->amount = $request->amount;
            $user->update();
            return back()->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function delete(Request $request)
    {
        try {
            // dd($request->id);
            $delete =  TravelDetails::where('id', $request->id)->delete();
            if ($delete) {
                return response()->json(['message' => 'Request Deleted Succesfully', 'status' => 'success']);
            }
            return response()->json(['message' => 'Request Deleted Failed', 'status' => 'error']);
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}