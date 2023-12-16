<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\TravelDetails;
use Illuminate\Support\Facades\Auth;
use App\Helpers\DropdownHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
                        $query->where('travel_details.approval_status', ['Approved']);
                    })->get();
                return DataTables::of($data)
                    ->make(true);
            }
            return view('admin.report');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
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

            $html = view('admin.view', compact('query', 'places', 'process'))->render();
            return response()->json(['html' => $html, 'success' => true]);
        } catch (Exception $ex) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function table(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::join('travel_details', 'users.emp_id', 'travel_details.employee_id')
                ->select('users.name', 'users.emp_id', 'users.usertype', 'travel_details.*')
                ->where(function ($query) {
                    $query->whereNotIn('travel_details.approval_status', ['Approved', 'Rejected'])
                          ->orWhereNull('travel_details.approval_status');
                })
                ->where('users.usertype', '<>', 3) // Exclude data when usertype is 'requester'
                ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        $btn = view('ajax.button', compact('user'))->render();
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.table');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->post() && $request->departure_city == $request->destination_city) {
                return redirect()->back()->with('error', 'The departure city and destination city must be different.');
            }
            $user = TravelDetails::find($request->travel_id);
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
            $user->approval_status = $request->approval_status;
            $user->remarks = $request->remarks;
            $user->approval_status_by = Auth::user()->name;

            $user->update();
            return back()->with('success', 'Request Updated Successfully');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}