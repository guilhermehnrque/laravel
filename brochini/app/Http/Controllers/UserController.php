<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
        $response = $this->userService->register($request);
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