<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\WorkPosition;
use DB;

class WorkPositionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('work_positions.index', []);
    }


    public function create(Request $request)
    {
        $workPosition = new WorkPosition;
        return view('work_positions.add', [
            'model' => $workPosition
        ]);
    }


    public function edit(Request $request, $id)
    {
        $workPosition = WorkPosition::findOrFail($id);
        return view('work_positions.add', [
            'model' => $workPosition
        ]);
    }


    public function show(Request $request, $id)
    {
        $workPosition = WorkPosition::findOrFail($id);
        return view('work_positions.show', [
            'model' => $workPosition
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM work_positions a ";
        
        if($_GET['search']['value']) {
            $presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $orderby = "";
        $columns = array('id','name',);
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
        $workPosition = null;
        
        if($request->id > 0) { 
            $workPosition = WorkPosition::findOrFail($request->id); 
        } else {
            $workPosition = new WorkPosition;
        }

        $workPosition->id = $request->id?:0;
        $workPosition->name = $request->name;
        $workPosition->save();

        return redirect('/work_positions');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }

    
    public function destroy(Request $request, $id) 
    {
        $workPosition = WorkPosition::findOrFail($id);
        $workPosition->delete();
        return "OK";
    }
}
