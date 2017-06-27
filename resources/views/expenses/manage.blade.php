@extends('layouts.app')
@section('content')
    @if(count($expenses) > 0)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Expense Details</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="col-md-3">Item</th>
                                        <th class="col-md-2">Amount</th>
                                        <th class="col-md-3">Category</th>
                                        <th>Purchased Date</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td>{{$expense->item_name}}</td>
                                            <td>{{$expense->currency->symbol }} {{$expense->amount}}</td>
                                            <td>{{$expense->category->label}}</td>
                                            <td>{{$expense->purchased_at}}</td>
                                            <td><a href="{{ route('expenses.edit', ['expense' => $expense->id]) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" style="color:gray"></span></a></td>
                                            <td>
                                                <form method="POST" action="{{ route('expenses.destroy', ['expense' => $expense->id]) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{$expenses->links()}}
            </div>
        </div>
    @else
        <div class="alert alert-info">
            No records available
        </div>
    @endif
    @include('components.addbutton', ['route' => route('expenses.create')])
@endsection