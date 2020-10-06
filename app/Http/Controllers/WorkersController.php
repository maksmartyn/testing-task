<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Worker;
use DB;

class WorkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('workers.index', []);
    }


    public function create(Request $request)
    {
        $worker = new Worker;
        return view('workers.add', [
            'model' => $worker
        ]);
    }


    public function edit(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);
        return view('workers.update', [
            'model' => $worker
        ]);
    }


    public function show(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);
        return view('workers.show', [
            'model' => $worker
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM workers a ";
        
        if($_GET['search']['value']) {
            $presql .= " WHERE department_id LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $orderby = "";
        $columns = array('id','department_id','position_id','adopted_at',);
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
        $worker = null;
        
        if($request->id > 0) { 
            $worker = Worker::findOrFail($request->id); 
        }else {
            $worker = new Worker;
        }

        $worker->department_id = $request->department_id;
        $worker->position_id = $request->position_id;
        $worker->adopted_at = $request->adopted_at;
        $worker->save();

        return redirect('/workers');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }


    public function destroy(Request $request, $id) 
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        return "OK";
    }
}
