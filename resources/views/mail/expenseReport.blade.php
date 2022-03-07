<div class="row">
    <div class="col">
        <h1>Expense report {{ $expenseReport->id }} : {{ $expenseReport->title }}</h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <h1>Expenses</h1>
        <table class="table">
            @foreach ($expenseReport->expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->created_at }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>