<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\course;
use App\Models\instructor;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function create()
    {
        return view('course_add'); // Adjust view path as necessary
    }

    // Method to store a new course
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255', // Course title
            'description' => 'required|string', // Course description
        ]);

        // Create a new course
        Course::create([ // Use uppercase 'C' for the Course model
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('course')->with('success', 'Course added successfully.');
    }

    // Method to show a specific course for editing
    public function course_edit($id)
    {
        $course = Course::findOrFail($id); // Use uppercase 'C' for the Course model
        return view('course_edit', compact('course')); // Adjust view path as necessary
    }

    // Method to update an existing course
    public function coures_update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Find the existing course
        $course = Course::findOrFail($id); // Use uppercase 'C' for the Course model

        // Update the course
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('course')->with('success', 'Course updated successfully.');
    }

    // Method to delete a course
    public function course_destroy($id)
    {
        $course = Course::findOrFail($id); // Use uppercase 'C' for the Course model

        // Delete the course
        $course->delete();

        return redirect()->route('course')->with('success', 'Course deleted successfully.');
    }

    // Method to show all courses
    public function index()
    {
        $courses = Course::all(); // Use uppercase 'C' for the Course model
        return view('course', compact('courses')); // Corrected to use 'courses'
    }

//Instructor crud operation

public function showAddInstructorForm()
{
    return view('instructor_add');
}

// Store a new instructor in the database
public function saveNewInstructor(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:instructors',
    ]);

    Instructor::create([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('instructor')->with('success', 'Instructor added successfully.');
}

// Display a list of all instructors
public function listInstructors()
{
    $instructors = Instructor::all();
    return view('instructor', compact('instructors'));
}

// Show the form to edit an existing instructor
public function showEditInstructorForm($id)
{
    $instructor = Instructor::findOrFail($id);
    return view('instructor_edit', compact('instructor'));
}

// Update an existing instructor's information
public function updateInstructorInfo(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:instructors,email,' . $id,
    ]);

    $instructor = Instructor::findOrFail($id);
    $instructor->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('instructor')->with('success', 'Instructor updated successfully.');
}

// Delete an instructor
public function deleteInstructor($id)
{
    $instructor = Instructor::findOrFail($id);
    $instructor->delete();

    return redirect()->route('instructor')->with('success', 'Instructor deleted successfully.');
}

//controller for users

public function listUsers()
{
    $users = User::all();
    return view('user', compact('users'));
}

public function showAddUserForm()
{
    return view('user_add');
}

public function saveNewUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('user')->with('success', 'User added successfully.');
}

public function showEditUserForm($id)
{
    $user = User::findOrFail($id);
    return view('user_edit', compact('user'));
}

public function updateUserInfo(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        // Only update the password if provided
        'password' => $request->password ? bcrypt($request->password) : $user->password,
    ]);

    return redirect()->route('users')->with('success', 'User updated successfully.');
}

public function deleteUser($id)
{
    // Find the user by ID
    $user = User::find($id);

    // Check if the user exists
    if (!$user) {
        return redirect()->route('users')->with('error', 'User not found.');
    }

    // Delete the user
    $user->delete();

    return redirect()->route('users')->with('success', 'User deleted successfully.');
}


}
