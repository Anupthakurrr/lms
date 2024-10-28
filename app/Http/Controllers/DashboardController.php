<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\instructor;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        // Retrieve counts from the database
        $coursesCount = course::count();
        $instructorsCount = instructor::count();
        $usersCount = User::count();

        // Pass the data to the view
        return view('dashboard', compact('coursesCount', 'instructorsCount', 'usersCount'));
    }
}


