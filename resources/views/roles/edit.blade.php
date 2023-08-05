@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form class="forms-sample" action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row row-eq-height">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <strong>Cập nhật vai trò</strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class=" col-form-label">Tên vai trò</label>
                                    <div class="">
                                        <input type="text" class="form-control" value="{{ $role->name }}" name="name" maxlength="130"
                                            placeholder="Tên nhóm quyền" required>
                                    </div>
                                    @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card" style="height: 100%">
                            <div class="card-header">
                                <strong>Phân quyền</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($groupPermissions as $groupPermission)
                                        <div class="col-md-3">
                                            <p class="text-uppercase">{{ $groupPermission->name }}</p>
                                            <div class="form-group form-group-per">
                                                @if (count($groupPermission->permissions) > 0)
                                                    @foreach ($groupPermission->permissions as $permission)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="{{ $permission->id }}" class="form-check-input"
                                                                    {{ in_array($permission->id, $role->permissions()->pluck('id')->toArray()) ? 'checked' : '' }}
                                                                >
                                                                {{ $permission->description }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>
    </form>
@endsection
