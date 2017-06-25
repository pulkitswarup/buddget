@extends('layouts.app')
@section('stylesheets')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('content')
    <div class="content bootstrap-iso">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Expense</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('expenses.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Item Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Specify the name of the item">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">€</span>
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required placeholder="Specify the amount of the item">
                                </div>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category">
                                    @foreach ($category as $key=>$val)
                                        <option value="{{ $key }}" {{ (old("category") == $key ? "selected":"") }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('purchased_date') ? ' has-error' : '' }}">
                            <label for="purchased_date" class="col-md-4 control-label">Purchase Date</label>
                            <div class="col-md-6">
                                <div class='input-group date' data-provide="datepicker">
                                    <input type='text' class="form-control" name="purchased_date" placeholder="dd-mm-yyyy" value="{{ old('purchased_date') }}" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                @if ($errors->has('purchased_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('purchased_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" class="form-control" rows="5" placeholder="Specify some description about the item">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        @if (count($groups) > 1)
                            <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                <label for="group" class="col-md-4 control-label">Group</label>

                                <div class="col-md-6">
                                    <select id="group" class="form-control" name="group">
                                        @foreach ($groups as $key=>$val)
                                            <option value="{{ $key }}" {{ (old("group") == $key ? "selected":"") }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    Reset
                                </button>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy',
       autoclose: true,
       todayHighlight: true
     });  
</script>
@endsection