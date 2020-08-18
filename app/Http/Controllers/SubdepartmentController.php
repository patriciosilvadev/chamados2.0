<?php

namespace App\Http\Controllers;

use App\Department;
use App\Subdepartment;
use Illuminate\Http\Request;
use App\Jobs\ChangeUserDepartment;

class SubdepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $subdepartments = new Subdepartment;
            $method = request('method');
            return $subdepartments->$method(request()->all());
        }
        return view('subdepartments.index');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     $departments = new Department;
    //     return view('subdepartments.create')
    //         ->with(['departments' => $departments->search()]);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $this->validateRequest($request);

    //     Subdepartment::create([
    //         'department_id' => request('department')['id'],
    //         'name' => strtolower(request('name')),
    //         'email' => strtolower(request('email')),
    //         'status' => Carbon::now()
    //     ]);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Subdepartment  $subdepartment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Subdepartment $subdepartment)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Subdepartment  $subdepartment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Subdepartment $subdepartment)
    // {
    //     $departments = new Department;
    //     $subdepartment = Subdepartment::whereId($subdepartment->id)->with(['department'])->first();
    //     return view('subdepartments.edit')->with([
    //         'subdepartment' => $subdepartment,
    //         'departments' => $departments->search()
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Subdepartment  $subdepartment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Subdepartment $subdepartment)
    // {
    //     if (request()->has('change_status')) {
    //         $subdepartment->changeStatus();
    //         return $subdepartment->fresh();
    //     }

    //     $this->validateRequest($request);

    //     $departmentId = $subdepartment->department_id;

    //     $subdepartment->update([
    //         'department_id' => request('department')['id'],
    //         'name' => request('name'),
    //         'email' => request('email')
    //     ]);

    //     if ($departmentId != request('department')['id']) {
    //         ChangeUserDepartment::dispatch($subdepartment->fresh());
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Subdepartment  $subdepartment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Subdepartment $subdepartment)
    // {
    //     //
    // }

    // public function validateRequest(Request $request)
    // {
    //     request()->validate([
    //         'department' => 'required',
    //         'name' => 'required',
    //         'email' => 'email|nullable',
    //     ]);
    // }
}
