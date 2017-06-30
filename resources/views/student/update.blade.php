@extends('common.layouts')

@section('content')
    <!-- 所有的错误提示 -->
    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                {{--取第一条错误信息,如果需要取出指定错误信息：{{$errors->first('student.name')}}--}}
                <li>{{$errors->first()}}</li>

            </ul>
        </div>
        <div class="alert alert-danger">
            <ul>
                {{--取出全部错误信息并输出--}}
                @foreach($errors->all() as $value)
                    <li>{{$value}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">修改学生</div>
        <div class="panel-body">
            @include('student._form')
        </div>
    </div>
@stop
