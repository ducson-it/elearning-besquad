<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Beesquad;
use App\Models\GroupPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupPermissions = GroupPermission::all();
        return view('permissions.list', compact('groupPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupPermissions = GroupPermission::all();
        return view('permissions.create', compact('groupPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $groupPermission = GroupPermission::where([
            'name' => $request->group_name
        ])->first();

        if (!$groupPermission) {
            $groupPermission = GroupPermission::create([
                'name' => $request->group_name
            ]);
        }

        Permission::create([
            'name' => $request->code,
            'description' => $request->name,
            'group_permission_id' => $groupPermission->id
        ]);
        return response([
            'success' => true,
            'data' => [
                'message' => 'Thêm dữ liệu thành công!'
            ]
        ]);
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
    public function edit($id)
    {
        $groupPermission = GroupPermission::find($id);
        return view('permissions.edit', compact('groupPermission', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $groupPermission = GroupPermission::find($id);
        $permission = Permission::find($request->id);

        if (!$groupPermission) {
            return response([
                'success' => false,
                'data' => [
                    'message' => 'Không tồn tại nhóm quyền!'
                ]
            ]);
        }

        if (!$permission) {
            return response([
                'success' => false,
                'data' => [
                    'message' => 'Không tồn tại quyền!'
                ]
            ]);
        }

        $groupPermission->update([
            'name' => $request->group_name,
        ]);

        $permission->update([
            'name' => $request->code,
            'description' => $request->name,
            'group_permission_id' => $groupPermission->id
        ]);

        return response([
            'success' => true,
            'data' => [
                'message' => 'Sửa dữ liệu thành công!'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $deltePermission = Permission::where('name', $code)->first()->delete();
        if (!$deltePermission) {
            return response([
                'success' => false,
                'data' => [
                    'message' => 'Không tồn tại quyền'
                ]
            ]);
        }

        return response([
            'success' => true,
            'data' => [
                'message' => 'Xóa thành công!'
            ]
        ]);
    }

    public function destroyGroupPermission($id)
    {
        $groupPermission = GroupPermission::findByID($id);
        $groupPermission->permissions()->delete();
        return redirect()->back();
    }
}
