
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa tài khoản</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="">
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="basiInput" value="Quan98">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="basiInput" value="quan98@gmail.com">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1BwYl1Svb2h_YRhj9tcnZk0yAuIHh3oBM03dzDa8f&s" alt="" width="100px"><br>
                                <label for="basiInput" class="form-label" style="margin-top: 60px">Tải ảnh đại diện</label>
                                <input type="file"  name="document" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">UserName</label>
                                <input type="text" class="form-control" id="basiInput" value="QuanDev">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="basiInput" value="09873482433">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Address</label>
                                <input type="text" class="form-control" id="basiInput" value="Hà Nam">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Loại tài khoản</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option value=""></option>
                                    <option value="1" selected>Giảng viên</option>
                                    <option value="2">Người dùng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Trạng thái</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option value=""></option>
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                <button type="button" class="btn btn-light"><a href="<?php echo e(route('user.list')); ?>">Trở lại</a></button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </form>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\Backend-Web07\resources\views/users/edit.blade.php ENDPATH**/ ?>