<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OldStudentController extends Controller
{
    public function index()
    {
        $oldStudent = auth()->guard('oldstudent')->user();
$modules = $oldStudent->completedModules()->get(); // only passed/failed
return view('oldstudent.dashboard', compact('modules'));

}
}
