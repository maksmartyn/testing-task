<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('users.index', []);
    }


    public function create(Request $request)
    {
        $user = new User;
        return view('users.add', [
            'model' => $user
        ]);
    }


    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('users.update', [
            'model' => $user
        ]);
    }


    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', [
            'model' => $user
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM users a ";
        
        if($_GET['search']['value']) {
            $presql .= " WHERE login LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $orderby = "";
        $columns = array('id','login','name','email','image','about','type','github','city','is_finished','phone','birthday','email_verified_at','password','remember_token','created_at','updated_at',);
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $orderby = "Order By " . $order . " " . $dir;

        $sql = $select.$presql.$orderby." LIMIT ".$start.",".$len;
    
        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        
        foreach ($results as $row) {
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];

        echo json_encode($ret);
    }


    public function update(Request $request) 
    {
        $user = null;
        if($request->id > 0) { 
            $user = User::findOrFail($request->id); 
        }else {
            $user = new User;
        }

        $user->login = $request->login;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $request->image;
        $user->about = $request->about;
        $user->type = $request->type;
        $user->github = $request->github;
        $user->city = $request->city;
        $user->is_finished = $request->is_finished;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/users');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }


    public function destroy(Request $request, $id) 
    {
        $user = User::findOrFail($id);
        $user->delete();
        return "OK";
    }
}
