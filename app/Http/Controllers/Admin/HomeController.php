<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Category;
use App\Models\Classs;
use App\Models\Course;
use App\Models\Location;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $campusesCount = Campus::count();
        $categoriesCount = Category::count();
        $subjectsCount = Subject::count();
        $classesCount = Classs::count();
        $semestersCount = Semester::count();
        $coursesCount = Course::count();
        $shiftsCount = Shift::count();
        $locationsCount = Location::count();
        return view('admin.home', compact(
            'usersCount',
            'campusesCount',
            'categoriesCount',
            'subjectsCount',
            'classesCount',
            'semestersCount',
            'coursesCount',
            'shiftsCount',
            'locationsCount'
        ));
    }
}
