<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RewardType;

class RewardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.rewards.index', ['rewards' => $rewards]);
    }

    public function create()
    {
        $types = RewardType::all();
        return view('admin.rewards.create', ['types' => $types]);
    }

    public function store(Request $request)
    {
        return Reward::createNewReward($request);
    }

    public function show($id)
    {
        $reward = Reward::getRewardById($id);
        return view('admin.rewards.show', ['reward' => $reward]);
    }

    public function edit($id)
    {
        $reward = Reward::getRewardById($id);
        return view('admin.rewards.edit', ['rewards' => $reward]);
    }

    public function update(Request $request, $id)
    {
        return Reward::updateReward($request, $id);
    }

    public function destroy($id)
    {
        $reward = Reward::deleteReward($id);
        return response()->json($reward);
    }    
}
