<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role != 1) {
                abort(404);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function logsServerSideOwn(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;

        // your table name 
        $query = User::where('role', '!=', 1)->when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                $q->where($key, $item);
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
        });
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        foreach ($row as $key => $item) {
            // dump($item);
            if($item['role'] == 1) {
                // Manger
                $row[$key]['role'] = 'Manger';
            } else if($item['role'] == 2) {
                // Recruiter
                $row[$key]['role'] = 'Recruiter';
            }
        }
        
        $index = $offset + 1;
        $data = [];

        $data['items'] = $row;
        $data['count'] = $count;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $reqData = $request->all();
        $reqData['password'] = Hash::make($request->password);
        User::create($reqData);
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('users/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, $id)
    {
        $reqData = $request->all();
        if($reqData['password']) {
            $reqData['password'] = Hash::make($request->password);
        } else {
            unset($reqData['password']);
        }
        // dd($reqData);
        $user = User::findOrFail($id);
        $user->update($reqData);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1 || $id == Auth::user()->id) {
            return response()->json(['success' => false, 'message' => 'User can not deleted']);
        } else {
            User::find($id)->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
        // return (new UsersExport)->download('users.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
    }

    public function changePassword(Request $request)
    {
        return view('users/changePassword');
    }

    public function changePasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.change_password')->withErrors($validator);
        }
        
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        if (!Hash::check($request->old_password, $user->password)) {
            $validator->errors()->add('old_password','Old Password is incorrect');
            return redirect()->route('user.change_password')->withErrors($validator);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.change_password')->with('success', 'Password changed successfully');
    }
}
