<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\GroupPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.list|roles.store|roles.update|roles.destroy', ['only' => ['index']]);
        $this->middleware('permission:roles.store', ['only' => ['create','store']]);
        $this->middleware('permission:roles.update', ['only' => ['edit','update']]);
        $this->middleware('permission:roles.destroy', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::All();
        return view('roles.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $role->create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $groupPermissions = GroupPermission::all();
        return view('roles.edit', compact('role', 'groupPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name
        ]);

        if ($request->permission) {
            $role->syncPermissions($request->permission);
        }

        return redirect()->route('roles.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::find($id);

            if ($role) {
                foreach ($role->permissions as $permission) {
                    $role->revokePermissionTo($permission);
                    $permission->delete();
                }
                $role->delete();
                DB::commit();
                return response([
                    'success' => true,
                    'message' => 'Xóa vai trò thành công!'
                ]);
            } else {
                DB::rollBack();
                return response([
                    'success' => false,
                    'message' => 'Không tìm thấy vai trò!'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'success' => false,
                'message' => 'Có lỗi xảy ra!'
            ]);
        }
    }
}
