@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm comment</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <label for="content">Nội dung comment:</label><br>
                            <textarea id="content" name="content" rows="4" cols="50"></textarea><br>

                            <label for="posts">Posts:</label>
                            <input type="checkbox" id="posts" name="tables[]" value="posts">
                            <div class="col-11">
                                <select name="post_id">
                                    @foreach ($posts as $post)
                                        <option value="{{ $post->id }}">{{ $post->content }}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <br>
                            <div class="col-11">
                                <label for="course">Courses:</label>
                                <input type="checkbox" id="courses" name="tables[]" value="courses">
                                <select name="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <br>
                            <div class="col-11">
                                <label for="lessons">Lessons:</label>
                                <input type="checkbox" id="lessons" name="tables[]" value="lessons">
                                <select name="lesson_id">
                                    @foreach ($lessons as $lesson)
                                        <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                    @endforeach
                                </select><br>
                            </div>

                            <div class="mx-6">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                    <button type="button" class="btn btn-primary"><a style="color: white" href="{{ route('comment.list') }}">Danh sách</a></button>
                                </div>
                            </div>
                        </form>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
