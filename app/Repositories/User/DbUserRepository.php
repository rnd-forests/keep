<?php  namespace Keep\Repositories\User; 

use Auth;
use Keep\User;

class DbUserRepository implements UserRepositoryInterface {

    public function all()
    {
        return User::all();
    }

    public function getAuthUser()
    {
        return Auth::user();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return User::findBySlug($slug);
    }

    public function findByCodeAndActiveState($code, $state)
    {
        return User::where('activation_code', '=', $code)
            ->where('active', '=', $state)->firstOrFail();
    }

    public function create(array $credentials)
    {
        return User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'activation_code' => str_random(60)
        ]);
    }

    public function update($slug, array $credentials)
    {
        $user = $this->findBySlug($slug);

        $user->update($credentials);

        return $user;
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function getTasks(User $user)
    {
        return $user->tasks()->latest('created_at')->paginate(10);
    }

}