<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/6/28
 * Time: 13:18
 */
namespace App\Http\Controllers;

use App\Student;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    public function index ()
    {
        //获取全部记录
        //$list = Student::get();
        //分页获取信息
        $list = Student::paginate(20);

        return view('student.index',[
            'list'  =>  $list,
        ]);
    }
    public function create (Request $request)
    {

        $student = new Student();

        if ($request->isMethod('post')) {
            //控制器使用验证 :attribute是固定占位符
//            $this->validate($request,[
//                'student.name'  =>  'required|min:2|max:10',
//                'student.age'   =>  'required|integer',
//                'student.sex'   =>  'required|integer',
//            ],[
//                'required'  =>  ':attribute 为必填项',
//                'min'   =>  ':attribute 最少为2两位',
//                'max'   =>  ':attribute 最多不许超过10位',
//                'integer' => ':attribute 必须为整数',
//            ],[
//                'student.name'  =>  '姓名',
//                'student.age'   =>  '年龄',
//                'student.sex'   =>  '性别',
//            ]);

            //Validator类验证
            $validate = \Validator::make($request->input(),[
                'student.name'  =>  'required|min:2|max:10',
                'student.age'   =>  'required|integer',
                'student.sex'   =>  'required|integer',
            ],[
                'required'  =>  ':attribute 为必填项',
                'min'   =>  ':attribute 最少为2两位',
                'max'   =>  ':attribute 最多不许超过10位',
                'integer' => ':attribute 必须为整数',
            ],[
                'student.name'  =>  '姓名',
                'student.age'   =>  '年龄',
                'student.sex'   =>  '性别',
            ]);
            //判断如果有错误信息
            if ($validate->fails()) {
                //返回上一页将错误信息传入withErrors(),withInput()将传递过来的数据返回到上一页，前端{{old('student.name')}}配合将数据输出
                return redirect()->back()->withErrors($validate)->withInput();
            }


            $data = $request->input('student');
            //注意，使用create() 需要在对应的模型里面开启批量添加字段 protected $fillable
            if (Student::create($data)){
                return redirect('Student/index')->with('success','添加成功！');
            }else{
                return redirect()->back();
            }
        }
        return view('student.create',['student'=>$student]);
    }

    /**
     * 使用模型增加数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save (Request $request)
    {

        $model = new Student();
        $data = $request->input('student');
        $model->name = $data['name'];
        $model->age = $data['age'];
        $model->sex = $data['sex'];
        if ($model->save()) {
            return redirect('Student/index');
        }else{
            return redirect()->back();
        }
    }


    public function update (Request $request,$id)
    {
        //获取指定数据
        $info = Student::find($id);

        if ($request->isMethod('post')) {

            $this->validate($request,[
                'student.name'  =>  'required|min:2|max:10',
                'student.age'   =>  'required|integer',
                'student.sex'   =>  'required|integer',
            ],[
                'required'  =>  ':attribute 为必填项',
                'min'   =>  ':attribute 最少为2两位',
                'max'   =>  ':attribute 最多不许超过10位',
                'integer' => ':attribute 必须为整数',
            ],[
                'student.name'  =>  '姓名',
                'student.age'   =>  '年龄',
                'student.sex'   =>  '性别',
            ]);

            $data = $request->input('student');
            $info->name = $data['name'];
            $info->age = $data['age'];
            $info->sex = $data['sex'];

            if ($info->save()) {
                return redirect('Student/index')->with('success','修改成功！');
            }else{
                return redirect()->back();
            }
        }

        return view('student.update',[
            'student'=>$info,
        ]);
    }


    public function delete ($id)
    {
        $student = Student::find($id);
        if ($student->delete()) {
            return redirect('Student/index')->with('success','删除成功！');
        }else{
            return redirect('Student/index')->with('error','删除失败！');
        }
    }

}