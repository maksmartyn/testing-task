<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserWorker;
use App\Models\Worker;
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
        
        if($_GET['search']['value']) {
            $userWorkers = UserWorker::where('user_id', 'LIKE', '%' . $_GET['search']['value'] . '%')->pluck('worker_id', 'user_id');
        } else {
            $userWorkers = UserWorker::pluck('worker_id', 'user_id');
        }

        foreach ($userWorkers as $user => $worker) {
            $item = User::find($user)->only('login', 'name', 'email', 'image', 'about', 'github');
            $item['adopted_at'] = implode(Worker::find($worker)->only('adopted_at'));
            $item['department'] = implode(Worker::find($worker)->department->pluck('name')->toArray());
            $item['position'] = implode(Worker::find($worker)->position->pluck('name')->toArray());
            $result[] = $item;
        }
        
        $slice = array_slice($result, $start, $len);
        
        foreach ($slice as $row) {
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
        $ret[] = $r;
        }
        
        $ret['data'] = $ret;
        $ret['recordsTotal'] = count($result);
        $ret['iTotalDisplayRecords'] = count($result);

        $ret['recordsFiltered'] = count($slice);
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

        $userWorker->user_id = $request->user_id;
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
