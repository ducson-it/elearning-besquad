
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa khoá học</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="">
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Tên khoá học</label>
                                <input type="text" class="form-control" id="basiInput" value="Lập trình web online">
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
                            <img src="https://hoclaptrinhonline.asia/pluginfile.php/2137/course/overviewfiles/la%CC%A3%CC%82p-tri%CC%80nh-web-min.png" alt="" width="200px">
                        </div>
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Tải anh lên</label>
                                <input type="file" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-8">
                            <div>
                                <label for="iconInput" class="form-label">Giá</label>
                                <div class="form-icon">
                                    <input type="number" class="form-control form-control-icon" id="iconInput" placeholder="" value="450000">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-8">
                            <div>
                                <label for="iconrightInput" class="form-label">Giá sale</label>
                                <div class="form-icon">
                                    <input type="number" class="form-control form-control-icon" id="iconInput" placeholder="" value="0">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-8">
                            <div>
                                <label for="exampleFormControlTextarea5" class="form-label">Example Textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                            </div>
                        </div>
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a href="<?php echo e(route('courses.list')); ?>">Trở lại</a></button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\Backend-Web07\resources\views/courses/edit.blade.php ENDPATH**/ ?>