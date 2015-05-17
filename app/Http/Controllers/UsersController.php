<?php namespace Keep\Http\Controllers;

use Keep\Http\Requests\EditUserProfileRequest;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller {

    protected $userRepo;

    /**
     * Create a new users controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;

        $this->middleware('auth');
        $this->middleware('auth.correct');
        $this->middleware('auth.confirmed');
    }

    /**
     * Show profile.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $user = $this->userRepo->findBySlug($slug);

        return view('users.show', compact('user'));
    }

    /**
     * Update profile.
     *
     * @param EditUserProfileRequest $request
     * @param                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditUserProfileRequest $request, $slug)
    {
        $user = $this->userRepo->updateProfile($slug, $request->except(['_method', '_token']));

        flash()->info('Your profile has been successfully updated.');

        return redirect()->route('users.show', $user);
    }

    /**
     * Cancel account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->userRepo->delete($slug);

        flash()->success("Your account has been deleted.");

        return redirect()->route('home');
    }

}
