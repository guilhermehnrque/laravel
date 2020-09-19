<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
        $response = User::create($request->all());
        return response()->json(['message' => 'User created', 'use_code' => $response->id], 201);
    }

    public function edit($id)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}