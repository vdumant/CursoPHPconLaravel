@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <h1>New Expense</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/expense_reports/{{ $expenseReport->id }}">back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/expense_reports/{{ $expenseReport->id }}/expenses" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Type description"
                    value="{{ old('description') }}"
                    >                    
                </div>
                <div class="form-group">
                    <label for="title">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Type amount"
                    value="{{ old('amount') }}"
                    >                    
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
