<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('admin.user.index');
    }
    public function viewAll()
    {
        $allData = User::where('type', 'user')->orderBy('id', 'DESC');
    return DataTables::of($allData)
        ->addIndexColumn()
        ->addColumn('plan_name', function ($data) {
            return $data->plan->name ?? '';
        })
        ->addColumn('action', '
            <div class="action-wrapper d-flex gap-4">
            <a  data-bs-toggle="tooltip"
              data-bs-placement="top" data-bs-title="User details" href="{{route(\'users.show\',$id)}}">
                <span>
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0003 12.8333V9.49996M10.0003 6.16663H10.0087M18.3337 9.49996C18.3337 14.1023 14.6027 17.8333 10.0003 17.8333C5.39795 17.8333 1.66699 14.1023 1.66699 9.49996C1.66699 4.89759 5.39795 1.16663 10.0003 1.16663C14.6027 1.16663 18.3337 4.89759 18.3337 9.49996Z" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                </span>
            </a>
            <a  data-bs-toggle="tooltip"
              data-bs-placement="top" data-bs-title="Edit admin information" href="{{route(\'users.edit\',$id)}}">
               <span>
               <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 15.1667H16.5M12.75 1.41669C13.0815 1.08517 13.5312 0.898926 14 0.898926C14.2321 0.898926 14.462 0.94465 14.6765 1.03349C14.891 1.12233 15.0858 1.25254 15.25 1.41669C15.4142 1.58085 15.5444 1.77572 15.6332 1.9902C15.722 2.20467 15.7678 2.43455 15.7678 2.66669C15.7678 2.89884 15.722 3.12871 15.6332 3.34319C15.5444 3.55766 15.4142 3.75254 15.25 3.91669L4.83333 14.3334L1.5 15.1667L2.33333 11.8334L12.75 1.41669Z" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

               </span>
            </a>
            <a data-bs-toggle="tooltip"
              data-bs-placement="top" data-bs-title="Delete Information"  title="Delete User" href="javascript:void(0)" type="button"
              onclick="resourceDelete(\'{{ route(\'users.destroy\', $id) }}\')">
                <span class="delete-icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 5H4.16667H17.5" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.8337 4.99996V16.6666C15.8337 17.1087 15.6581 17.5326 15.3455 17.8451C15.0329 18.1577 14.609 18.3333 14.167 18.3333H5.83366C5.39163 18.3333 4.96771 18.1577 4.65515 17.8451C4.34259 17.5326 4.16699 17.1087 4.16699 16.6666V4.99996M6.66699 4.99996V3.33329C6.66699 2.89127 6.84259 2.46734 7.15515 2.15478C7.46771 1.84222 7.89163 1.66663 8.33366 1.66663H11.667C12.109 1.66663 12.5329 1.84222 12.8455 2.15478C13.1581 2.46734 13.3337 2.89127 13.3337 3.33329V4.99996" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.33301 9.16663V14.1666" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.667 9.16663V14.1666" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </span>
            </a>
        </div>

            
        ')
        ->rawColumns(['action', 'checkbox','plan_name'])
        ->toJson();
    }
    /**
     * Create new Admin
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|max:100',
            'email' => "required|email|unique:users,email",
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $input = $request->except(['_token', '_method']);
            if ($request->hasFile('avatar')) {
                $input['avatar'] = fileUpload($request->file('avatar'), 'user', $request->name);
            }
            $input['password'] = Hash::make($request->password);
            $input['type'] = 'admin';
            
            User::create($input);
            myAlert('success','Updated successfully');
            return back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            myAlert('error',$errorMessage);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$id",
            'phone' => 'required',
        ]);

        try {
            $data = User::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            if ($request->hasFile('avatar')) {
                $input['avatar'] = fileUpload($request->file('avatar'), 'user', $request->name);
            }
            
            $data->update($input);
            myAlert('success','Updated successfully');
            return back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            myAlert('error',$errorMessage);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = User::findOrFail($id);
            fileDelete($data->avatar);
            $data->delete();
            myAlert('success', 'Data is deleted');
            return back();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            myAlert('Error', $errorMessage);
            return back();
        }
    }
    public function allAdmin()
    {
        $allData = User::where('type', 'admin')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.user.admin',compact('allData'));
    }
}
