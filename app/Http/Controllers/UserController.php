<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use App\Exports\LogsExport;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\Userstatus;
use Illuminate\Bus\UpdatedBatchJobCounts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        if (Gate::allows('isAdmin')) {
            // $users = User::orderBy('updated_at', 'asc')->take(5)->get();
            $users = User::all();
            foreach ($users as $user) {
                $user->status;
                $user->roles;
            }
            return view('user.allUsers')->with([
                'users' => $users
            ]);
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $branches = Branch::all();
        $departments = Department::all();
        $roles = Role::all();
        return view('user.addUser')->with([
            'organizations' => $organizations,
            'branches' => $branches,
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                // 'middleName' =>  ['string', 'max:255'],
                'lastName' =>  ['required', 'string', 'max:255'],
                'userID' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required',
                'birthDate' => 'required',
                'organizationId' => 'required',
                'branchId' => 'required',
                'departmentId' => 'required',
                'roles' => 'required'

            ]);
            $organization = Organization::find($request->input('organizationId'));
            $branch = Branch::find($request->input('branchId'));
            $department = Department::find($request->input('departmentId'));
            $user = new User();
            $user->user_id = $request->input('userID');
            $user->first_name = $request->input('firstName');
            $user->organization_id = $request->input('organizationId');
            $user->branch_id = $request->input('branchId');
            $user->middle_name = $request->input('middleName');
            $user->last_name = $request->input('lastName');
            $user->phone_number = $request->input('phoneNumber');
            $user->birth_date = $request->input('birthDate');
            $user->email = $request->input('email');
            $user->password = Hash::make(strtoupper($request->input('lastName')));

            // //check if just a staff set password null
            // if (count($request->input('roles')) == 1 && $request->input('roles')[0] == 5) {
            //     $user->password = null;
            // } else {
            //     $user->password = Hash::make(strtoupper($request->input('lastName')));
            // }

            //associate roles then save user
            $user->status()->create();
            $user->roles()->sync($request->input('roles'));
            $department->users()->save($user);
            return redirect()->route('allUsers', Auth::user()->user_id);
        }

        if (Gate::denies('isAdmin')) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'middleName' =>  ['required', 'string', 'max:255'],
                'lastName' =>  ['required', 'string', 'max:255'],
                'userID' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required',
                'birthDate' => 'required',
                'organizationId' => 'required',
                'branchId' => 'required',
                'departmentId' => 'required',
            ]);


            $organization = Organization::find($request->input('organizationId'));
            $branch = Branch::find($request->input('branchId'));
            $department = Department::find($request->input('departmentId'));
            $user = new User();
            $user->user_id = $request->input('userID');
            $user->first_name = $request->input('firstName');
            $user->organization_id = $request->input('organizationId');
            $user->branch_id = $request->input('branchId');
            $user->middle_name = $request->input('middleName');
            $user->last_name = $request->input('lastName');
            $user->phone_number = $request->input('phoneNumber');
            $user->birth_date = $request->input('birthDate');
            $user->email = $request->input('email');
            $user->password = Hash::make(strtoupper($request->input('lastName')));
            $staffRole = Role::where('name', 'staff')->first();

            //associate roles then save user
            $user->status()->create();
            $user->roles()->attach($staffRole);
            $department->users()->save($user);

            return redirect()->route('allUsers', Auth::user()->user_id);
        }
    }

    public function employee(Request $request)
    {
        $user = new User();
            $user->user_id = $request->input('userID');
            $user->fingerprint_device_token2 = $request->input('token');

            $user->User_name = $request->input('fullname');
           
            $user->phone_number = $request->input('phoneNumber');
            $user->birth_date = $request->input('birthDate');
            $user->email = $request->input('email'); 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Staff(Request $request)
    {
         $staff = new Staff();
            $staff->user_id = $request->input('userID');
            $staff->first_name = $request->input('firstName');
            $staff->last_name = $request->input('lastName');
            $staff->gender = $request->input('gender');
            $staff->phone_number = $request->input('phoneNumber');
            $staff->email = $request->input('email');
            $staff->department = $request->input('department');
            $staff->password = Hash::make(strtoupper($request->input('lastName')));
            // $staffRole = Role::where('name', 'staff')->first();

            // $staff->status()->create();
            // $staff->roles()->attach($staffRole);
            $staff->save();

            return redirect()->route('allUsers', Auth::user()->user_id);
            // return $staff;

    }
   
    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile')->with([
            'user' => $user,
            'roles' => $user->roles
        ]);
    }

    public function details()
    {
        return view('user.details');
    }

    public function fingerprintEnroll(Request $request)
    {
        $tt = Staff::where('user_id',$request->input('user_id'))->update([
            'fingerprint_device_token' => $request->input('txtIsoTemplate')
        ]);

        if($tt) {
            return redirect()->back() ->with('alert', 'fingerprint enrolled successfully');

        }

        else{
        return "Repeat";
        }

    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
    public function users(User $user)
    {
      
    $users = DB::table('users')->get();

    // return view('check', ['users' => $users]);
    // return $users;
    return view('user.allUsers')->with([
        'logs' => $user->first_name,
        'type' => 1
    ]);

    }
    // public function users2(Request $request)
    // {
    //     if ($request->ajax()) {
    //         // $users = User::all();
    //         $data = User::latest()->get();
    //         // return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }



    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        if (!$userId) {
            return response()->json(['error' => 'user do not exist'], 504);
        }
        $user->status()->update([
            'delete_status' => 1
        ]);
        // $user->delete();

        return redirect()->route('allUsers', Auth::user()->user_id);
    }

    public function showchangePassword()
    {
        return view('user.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required|min:5',
        ]);
        if (Hash::check($request->input('currentPassword'), Auth::user()->password)) {
            User::find(Auth::user()->user_id)->update(['password' => Hash::make($request->input('password'))]);
            Auth::logout();
            return redirect('/');
        }
    }

    public function showAll()
    {
        // $user = Userstatus::where('card_uid' , 111)->first();
        $users = User::all();
        foreach ($users as $user) {
            $user->status;
            $user->roles;
            $user->fingerprintDevice;
            $user->rfidDevice;
            $user->rooms;
        }
        // if($user){
        //     $id = $user->user_id;
        //     return response()->json([
        //         'users' => $user->user
        //     ]);
        // }
        return response()->json([
            'users' => $users
        ]);
    }

    public function showOne($id)
    {
        $user = User::find($id);

        $user->status;
        $user->roles;
        foreach ($user->department->branch->organization->branches as $branches) {
            $branches->departments;
        };
        return response()->json([
            'user' => $user
        ]);
    }


    public function fingerPrintId($deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->fingerprintUsers;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->ready_to_enroll) {

                        return "user_id".$user->status->fingerprint_id;
                    } else {
                        continue;
                    }
                }
                return 'No user ready for enrollment';
            }
        } else {
            return "Device not found";
        }
    }

    public function deleteUserEnrolled($deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->fingerprintUsers;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->delete_status) {
                        $user->status()->update([
                            'delete_status' => 0
                        ]);
                        $user->delete();
                        return "user_id".$user->status->fingerprint_id;
                        //logics to delete user in the system

                    } else {
                        continue;
                    }
                }

                return "No user to delete";
            }
        } else {
            return "Device not found";
        }
    }



    public function confirmEnrollment($fingerPrintId, $deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->fingerprintUsers;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->fingerprint_id == $fingerPrintId && $user->status->ready_to_enroll == 1) {
                        $user->status->update([
                            'ready_to_enroll' => 0,
                            'enrollment_status' => 1
                        ]);
                        return "success"."Succesfull Enrolled";
                        // return redirect()->route('showUserDetails', $user->user_id);
                    } else {
                        continue;
                    }
                }
                return 'No user to confirm';
            }
        } else {
            return "Device not found";
        }
    }




    // EXCELL EXPORT

    public function exportAllUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    
    public function exportAllLogs()
    {
        return Excel::download(new LogsExport, 'logs.xlsx');
    }
}
