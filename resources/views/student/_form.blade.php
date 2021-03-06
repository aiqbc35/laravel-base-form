<form class="form-horizontal" method="post" action="">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名</label>

        <div class="col-sm-5">
            <input type="text" name="student[name]" value="{{old('student.name') ? old('student.name') : $student->name}}" class="form-control" id="name" placeholder="请输入学生姓名">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{$errors->first('student.name')}}</p>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">年龄</label>

        <div class="col-sm-5">
            <input type="text" name="student[age]" value="{{old('student.age') ? old('student.age') : $student->age}}" class="form-control" id="age" placeholder="请输入学生年龄">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{$errors->first('student.age')}}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">性别</label>

        <div class="col-sm-5">
            @foreach ($student->sex() as $key=>$value)
                <label class="radio-inline">
                    {{--{{ isset($student->sex) && $student->sex == $key ? 'checked' : '' }}--}}
                    <input type="radio" {{ isset($student->sex) && $student->sex == $key ? 'checked' : '' }} name="student[sex]"  value="{{$key}}"> {{$value}}
                </label>
            @endforeach

        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{$errors->first('student.sex')}}</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>