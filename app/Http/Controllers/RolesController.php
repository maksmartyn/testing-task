<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use DB;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('roles.index', []);
    }


    public function create(Request $request)
    {
        $role = new Role;
        return view('roles.add', [
            'model' => $role
        ]);
    }


    public function edit(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.update', [
            'model' => $role
        ]);
    }


    public function show(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', [
            'model' => $role
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM roles a ";
        
        if($_GET['search']['value']) {
            $presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $orderby = "";
        $columns = array('id','name','slug','created_at','updated_at',);
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
        $role = null;
        
        if($request->id > 0) { 
            $role = Role::findOrFail($request->id); 
        }else {
            $role = new Role;
        }
        
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        return redirect('/roles');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }


    public function destroy(Request $request, $id) 
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return "OK";
    }
}
