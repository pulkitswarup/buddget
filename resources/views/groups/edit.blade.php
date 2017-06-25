@extends('layouts.app')
@section('stylesheets')
    <link href="https://goodies.pixabay.com/jquery/tag-editor/jquery.tag-editor.css" rel="stylesheet">
    <style>
        #share+.tag-editor {
            display: block;
            padding: 4px 0px;
            font-size: inherit;
            line-height: 1.6;
            color: #555555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccd0d2;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
            font-family: inherit;
            margin: 0;
            letter-spacing: normal;
            word-spacing: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
        }
    </style>
@endsection
@section('content')
    <div class="content bootstrap-iso">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modify Group</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('groups.update', ['group' => $group->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Group Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $group->name }}" required autofocus placeholder="Specify the name of the group">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" class="form-control" rows="5" placeholder="Specify some description about the group">{{ old('description') ? old('description') : $group->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('share') ? ' has-error' : '' }}">
                            <label for="share" class="col-md-4 control-label">Share</label>

                            <div class="col-md-6">
                                <input id="share" type="text" class="form-control" name="share" value="{{ old('share') ? old('share') : $share }}" placeholder="Enter email addresses...">

                                @if ($errors->has('share'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('share') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <input type="hidden" name="_method" value="PUT">

                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://goodies.pixabay.com/jquery/tag-editor/jquery.caret.min.js"></script>
    <script src="https://goodies.pixabay.com/jquery/tag-editor/jquery.tag-editor.js"></script>
    <script>
    $(function() {
        $('#share').tagEditor({
            initialTags: [],
            delimiter: ', ', /* space and comma */
            placeholder: 'Enter email addresses...',
            removeDuplicates: true,
            animateDelete: 0
        });

        $("#share+.tag-editor").focusin(function() {
            $(this).css('border-color', '#98cbe8');
            $(this).css('outline:', '0');
            $(this).css('box-shadow', 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(152, 203, 232, 0.6)');
            $(document.activeElement).focusout(function(){
                $("#share+.tag-editor").css('border', '1px solid #ccd0d2');
                $("#share+.tag-editor").css('box-shadow', 'inset 0 1px 1px rgba(0, 0, 0, 0.075)');
            });
        });
    });

    </script>
@endsection