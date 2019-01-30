<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends ApiController
{
    
    public function index() {
        
        return $this->showAll(User::latest('updated_at')->get());
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        return $this->showOne(
            
            User::create($request->all())
            
        );
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            
            'name' => $request->input('name') ?? $user->name,
            'email' => $request->input('email') ?? $user->email,
            'role' => $request->input('role') ?? $user->role,
            'avatar' => $request->input('avatar') ?? $user->avatar,
            
        ]);
    
        return $this->showOne($user);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
    
        return $this->showOne($user);
    }
    
}
