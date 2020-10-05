<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use DB;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        return view('permissions.index', []);
    }


    public function create(Request $request)
    {
        $permission = new Permission;
        return view('permissions.add', [
            'model' => $permission
        ]);
    }


    public function edit(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.add', [
            'model' => $permission
        ]);
    }


    public function show(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', [
            'model' => $permission
        ]);
    }


    public function grid(Request $request)
    {
        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT *,1,2 ";
        $presql = " FROM permissions a ";
        
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
        $permission = null;
        
        if($request->id > 0) { 
            $permission = Permission::findOrFail($request->id); 
        }else {
            $permission = new Permission;
        }
        
        $permission->id = $request->id?:0;
        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->created_at = $request->created_at;
        $permission->updated_at = $request->updated_at;
        $permission->save();

        return redirect('/permissions');
    }


    public function store(Request $request)
    {
        return $this->update($request);
    }


    public function destroy(Request $request, $id) 
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return "OK";
    }
}
