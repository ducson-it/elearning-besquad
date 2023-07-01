
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa bài học</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="">
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Tên bài học</label>
                                <input type="text" class="form-control" id="basiInput" value="Giới thiêu lập trình website">
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Danh mục</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option value=""></option>
                                    <option value="1" selected>Khoá học miễn phí</option>
                                    <option value="2">Khoá học mât phí</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Tải video</label>
                                <input type="file" name="video" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Tải tài liệu</label>
                                <input type="file"  name="document" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-8">
                            <div>
                                <label for="exampleFormControlTextarea5" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</textarea>
                            </div>
                        </div>
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a href="<?php echo e(route('courses.lessons.list',[$course,$topic])); ?>">Trở lại</a></button>
                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\Backend-Web07\resources\views/lessons/edit.blade.php ENDPATH**/ ?>