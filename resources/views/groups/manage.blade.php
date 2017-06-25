@extends('layouts.app')
@section('content')
    @if(count($groups) > 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Group Details</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="col-md-4">Group Name</th>
                                        <th class="col-md-2">Created On</th>
                                        <th class="col-md-4">Shared / Private</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{$group->name}}</td>
                                            <td>{{$group->created_at}}</td>
                                            <td>
                                                @if ($group->users()->count() > 1)
                                                    Shared
                                                @else
                                                    Private
                                                @endif
                                            </td>
                                            <td><a href="{{ route('groups.edit', ['group' => $group->id]) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" style="color:gray"></span></a></td>
                                            <td>
                                                <form method="POST" action="{{ route('groups.destroy', ['group' => $group->id]) }}">
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
                {{$groups->links()}}
            </div>
        </div>
    @else
        <div class="alert alert-info">
            No groups available
        </div>
    @endif
    @include('components.addbutton', ['route' => route('groups.create')])
@endsection