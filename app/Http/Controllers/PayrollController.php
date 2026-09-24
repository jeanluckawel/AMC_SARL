<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Employee::with([
            'department',
            'section',
            'jobTitle',
            'salary',
        ])
            ->orderBy('employee_id', 'asc')
            ->get();

        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
