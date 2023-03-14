<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): object
    {
        $users = User::paginate(5);

        return UserResource::collection($users);
    }

    public function show(User $user): object
    {
        return new UserResource($user);
    }

    public function store(UserStoreRequest $request): object
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }

    public function update(UserUpdateRequest $request, User $user): object
    {
        $data = $request->validated();

        $user->update($data);

        return $user;
    }

    public function delete(User $user): mixed
    {
        $user->delete();
        return response('', 204);
    }
}
