<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $newFirstName = $request->validated()['firstName'];
        $newLastName = $request->validated()['lastName'];
        
        $employee = Employee::where('firstName', $newFirstName)->first();


        if ($employee) {
            $oldFullName = $employee->firstName . ' ' . $employee->lastName;

            $newFullName = $newFirstName . ' ' . $newLastName;

            if($oldFullName == $newFullName) {
                return response()->json(['message' => 'Employee already exists'], 309);
            }
        } 

        $employee = Employee::create($request->validated());

        return (new EmployeeResource($employee))->response()->setStatusCode(200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($employee)
    {
        $employee = Employee::find($employee);

        if (!$employee) {
            return response()->json(['message' => 'Employee does not exist.'], 404);
        } 

        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $employee)
    {
        $employee = Employee::find($employee);

        if (!$employee) {
            return response()->json(['message' => 'Employee does not exist'], 404);
        } 

        $employee->update($request->validated());

        return new EmployeeResource($employee); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee)
    {
        $employee = Employee::find($employee);

        if (!$employee) {
            return response()->json(['message' => 'Employee does not exist'], 404);
        } 

        $employee->delete();

        return response([], 200);
    }
}
