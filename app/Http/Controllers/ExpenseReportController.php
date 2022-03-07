<?php

namespace App\Http\Controllers;

use App\ExpenseReport;
use App\Mail\SummaryReport;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class ExpenseReportController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }    

    public function index()
    {
        return view('expenseReport.index', [
            'expenseReports' => ExpenseReport::all()
        ]);
    }

    public function create()
    {
        return view('expenseReport.create');
    }


    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required|min:3'
        ]);

        $report = new ExpenseReport();
        $report->title = $request->get('title');
        $report->save();

        return redirect('/expense_reports');
    }

    public function show(ExpenseReport $expenseReport)
    {
        return view('expenseReport.show', compact('expenseReport'));
    }

    public function edit($id)
    {
        $report = ExpenseReport::findOrFail($id);
        return view('expenseReport.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $report = ExpenseReport::findOrFail($id);
        $report->title = $request->get('title');
        $report->save();

        return redirect('/expense_reports');
    }

    public function destroy($id)
    {
        $report = ExpenseReport::findOrFail($id);
        $report->delete();

        return redirect('/expense_reports');
    }

    public function confirmDelete($id)
    {
        $report = ExpenseReport::findOrFail($id);
        return view('expenseReport.confirmDelete', compact('report'));
    }

    public function confirmSendEmail($id)
    {
        $expenseReport = ExpenseReport::findOrFail($id);
        return view('expenseReport.confirmSendEmail', compact('expenseReport'));
    }

    public function sendEmail(Request $request, $id)
    {
        // dd(getenv('MAIL_PORT'));
        $expenseReport = ExpenseReport::findOrFail($id);
        Mail::to($request->get('email'))->send(new SummaryReport($expenseReport));

        return redirect("/expense_reports/$id");
    }
}
