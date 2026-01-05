<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Student;
use Carbon\Carbon;

class ResultController extends Controller
{
    public function complete(Module $module, Student $student, $status)
    {
        $student->modules()->updateExistingPivot($module->id, [
            'status' => $status, // passed / failed
            'completed_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Result updated');
    }
}
