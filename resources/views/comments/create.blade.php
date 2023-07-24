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
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Nội dung comment:</label>
                                            <textarea id="content" name="content" class="form-control" rows="4" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Chọn các bài viết, bài học và khóa học liên quan:</label>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="posts" name="tables[]" value="posts">
                                                <label class="form-check-label" for="posts">Posts:</label>
                                                <select name="post_id" class="form-select">
                                                    @foreach ($posts as $post)
                                                        <option value="{{ $post->id }}">{{ $post->content }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="courses" name="tables[]" value="courses">
                                                <label class="form-check-label" for="courses">Courses:</label>
                                                <select name="course_id" class="form-select">
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="lessons" name="tables[]" value="lessons">
                                                <label class="form-check-label" for="lessons">Lessons:</label>
                                                <select name="lesson_id" class="form-select">
                                                    @foreach ($lessons as $lesson)
                                                        <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-success">Thêm</button>
                                            <a href="{{ route('comment.list') }}" class="btn btn-primary">Danh sách</a>
                                        </div>
                                    </div>
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
