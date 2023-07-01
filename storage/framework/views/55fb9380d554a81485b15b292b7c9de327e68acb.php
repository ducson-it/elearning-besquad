
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tạo bài viết</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="">
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="basiInput" value="Học lập trình web cần chuẩn bị gì?">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="exampleFormControlTextarea5" class="form-label">Mô tả ngắn</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3">Học lập trình web cần chuẩn bị gì?</textarea>
                            </div>
                        </div>
                        <div class="col-11">
                            <label class="label-control mb-2">Nội dung</label>
                            <div id="quillEditor"></div>
                            <textarea name="content" id="content" class="d-none"></textarea>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label" style="margin-top: 60px">Tải ảnh đại diện</label>
                                <input type="file"  name="document" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Chủ đề</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option selected=""></option>
                                    <option value="1">Lập trình web</option>
                                    <option value="2">Lập trình front end</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                <button type="button" class="btn btn-light"><a href="<?php echo e(route('blog.list')); ?>">Trở lại</a></button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\Backend-Web07\resources\views/blog/edit.blade.php ENDPATH**/ ?>