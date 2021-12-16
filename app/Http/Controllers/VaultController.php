<?php

namespace App\Http\Controllers;

use App\Events\SiteCreatedEvent;
use Illuminate\Http\Request;
use App\Models\Vault;
use App\Models\User;
use Illuminate\support\Facades\crypt;
use Validator;
use Auth;
use DataTables;

class VaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('vaults.index2');
    }
    public function showSites(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            $data = Vault::
            with('user')
            ->whereHas('user', function($query) use ($user_id) {
                $query->where('id', $user_id);
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass('{{$id % 2 == 0 ? "alert-success" : "alert-warning"}}')
                ->addColumn('action',
                    '<a class="edit btn btn-warning btn-sm showPassword" href="{{route("vaults.showpassword", $id)}}"> Show Password</a>
                    <a class="edit btn btn-success btn-sm editVault" href="{{route("vaults.edit", $id)}}"> Edit</a>
                    <a class="delete btn btn-danger btn-sm removeVault" href="{{route("vaults.destroy", $id)}}"> Remove</a>
                ')
                ->editColumn('password','***********')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function userIndex()
    {
        return view('users.index1');
    }

    public function showUsers(Request $request)
    {
        if($request -> ajax())
        {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

    }

    public function create()
    {
        return view('vaults.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'url' => 'required|string|between:3,100',
            'username' => 'required|string|between:3,100',
            'password' => 'required|string|between:3,100'
        ]);

        if($validator->validated())
        {
            $currentUser = Auth::user();
            if($currentUser)
            {
                $vault = new Vault;
                $vault->title = $request->input('title');
                $vault->url = $request->input('url');
                $vault->username = $request->input('username');
                $vault->password = Crypt::encryptString($request->input('password'));
                $vault->user_id = $currentUser->id;
                $vault->save();

            }
            $createdMessage ="Site has been Successfully Added <a href=\"http://omnivault.test/vaults\">See My Sites</a>";
            event(new SiteCreatedEvent($currentUser->email,$createdMessage));
        }
      return redirect()->route('vaults.index')
            ->with('success','Site created successfully');

    }

    public function validatePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'password' => 'required|string|between:3,20'
        ]);
        if($validator->validated())
        {
            $user = Auth::user();

            if(password_verify($request->password,$user->password))
            {
                return response()->json(['status'=> 'success', 'message' => 'Success'],200);
            }
            return response()->json(['status'=> 'failed','message' => 'FAILED'],200);
        }
    }


    public function showPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required|string|between:3,20'
        ]);
        if($validator->validated())
        {
            $user = Auth::user();
            logger($user);
            if(password_verify($request->password,$user->password))
            {
                $vaultPassword = Vault::find($id);
                logger($vaultPassword);
                $decrypt = Crypt::decryptString($vaultPassword->password);
                logger($decrypt);
                return response()->json([
                        'status' => 'success',
                        'message' => 'Success',
                        'password' => $decrypt
                    ],200);
            }
            return response()->json(['status'=>'failed','message'=>'FAILED'],200);
        }
    }


    public function edit($id)
    {
        $vault = Vault::find($id);
        $decryptPassword =Crypt::decryptString($vault->password);
        return view('vaults.edit',compact('vault','decryptPassword'));
    }


    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'string|between:2,50',
            'url' => 'string|between:3,100',
            'username' => 'string|between:3,100',
            'password' => 'required|string|between:3,100'
        ]);
        if($validator->validated()) {
            $user = Vault::find($id)->update(array_merge(
                $validator->validated(),
                ['password' => Crypt::encryptString($request->password)]
            ));
        }
        $currentUser=Auth::user();
        $createdMessage ="Site has been Successfully Updated Site url:$request->url<a href=\"http://omnivault.test/vaults\">See My Sites</a>";
        event(new SiteCreatedEvent($currentUser->email,$createdMessage));

        return redirect()->route('vaults.index')
            ->with('success','site updated successfully');
    }

    public function destroy($id)
    {
        $vault = Vault::find($id);
        $vault->delete();

//        return redirect()->route('vaults.index')
//            ->with('success','Site deleted successfully');
        return response()->json([
            'status' => 'success',
            'message' => 'success',
        ],200);
    }

}
