<?php namespace Keep\Http\Controllers;

use Keep\Http\Requests\EditUserProfileRequest;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller {

    /**
     * The user repository.
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Create a new users controller instance.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
        $this->middleware('auth.confirmed');
        $this->middleware('auth.correct');
    }

    /**
     * Show the user profile page.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
	public function show($slug)
	{
        $user = $this->userRepository->findBySlug($slug);

		return view('users.show', compact('user'));
	}

    /**
     * Update the user profile.
     *
     * @param EditUserProfileRequest $request
     * @param                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function update(EditUserProfileRequest $request, $slug)
	{
        $user = $this->userRepository->update($slug, $request->all());

        flash()->info('Your profile has been successfully updated.');

        return redirect()->route('users.show', $user->slug);
	}

    /**
     * Delete user account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function destroy($slug)
	{
		$this->userRepository->delete($slug);

        flash()->success("Your account has been deleted.");

        return redirect()->route('home_path');
	}

}
