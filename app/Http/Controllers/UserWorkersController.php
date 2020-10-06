<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserWorker;
use DB;

class UserWorkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('user_workers.index', []);
    }

    public function create(Request $request)
    {
        $userWorker = new UserWorker;
        return view('user_workers.add', [
            'model' => $userWorker
        ]);
    }


    public function edit(Request $request, $id)
    {
        $userWorker = UserWorker::findOrFail($id);
        return view('user_workers.update', [
            'model' => $userWorker    
        ]);
    }


    public function show(Request $request, $id)
    {
        $userWorker = UserWorker::findOrFail($id);
        return view('user_workers.show', [
            'model' => $userWorker    
        ]);
    }

    
    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM user_workers a ";

        if($_GET['search']['value']) {
            $presql .= " WHERE login LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $orderby = "";
        $columns = array('id','login','name','email','image','about','type','github','worker_id',);
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


    public function update(Request $request) {
        $userWorker = null;

        if($request->id > 0) { 
            $userWorker = UserWorker::findOrFail($request->id); 
        } else {
            $userWorker = new UserWorker;
        }

        $userWorker->login = $request->login;
        $userWorker->name = $request->name;
        $userWorker->email = $request->email;
        $userWorker->image = $request->image;
        $userWorker->about = $request->about;
        $userWorker->type = $request->type;
        $userWorker->github = $request->github;
        $userWorker->worker_id = $request->worker_id;
        $userWorker->save();
    
        return redirect('/user_workers');
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy(Request $request, $id) 
    {
        $userWorker = UserWorker::findOrFail($id);
        $userWorker->delete();
        return "OK";
    }
}
