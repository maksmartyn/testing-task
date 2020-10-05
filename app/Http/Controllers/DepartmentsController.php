<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Auth;
use DB;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('departments.index', []);
    }


    public function create(Request $request)
    {
        $department = new Department;
        return view('departments.add', [
            'model' => $department
        ]);
    }


    public function edit(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.add', [
            'model' => $department
        ]);
    }


    public function show(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.show', [
            'model' => $department
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM departments a ";
        
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
        $department = null;
        if($request->id > 0) { 
            $department = Department::findOrFail($request->id); 
        }else {
            $department = new Department;
        }
        $department->id = $request->id?:0;
        $department->name = $request->name;
        $department->save();

        return redirect('/departments');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }


    public function destroy(Request $request, $id) 
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return "OK";
    }
}
