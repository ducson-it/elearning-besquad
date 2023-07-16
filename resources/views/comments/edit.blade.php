@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa comment</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" action="{{ route('comment.update', $comments->id) }}" >
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center">
                                    <div>
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            @foreach (['Inactive', 'Active'] as $value)
                                                <option value="{{ strtolower($value) }}" @if ($comments->status == strtolower($value)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <br>
                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                        <button type="button" class="btn btn-warning"><a href="{{route('comment.list')}}">Trở lại</a></button>
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
