@extends('layouts.master')
@section('content')
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tạo bài viết</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form method="POST" enctype="multipart/form-data" action="{{route('blogs.update',$blog->id)}}" >
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="col-11">
                                            <div>
                                                <label for="basiInput" class="form-label">Tiêu đề</label>
                                                <input type="text" class="form-control" name="title" id="name" oninput="generateSlug()" value="{{ old('title', $blog->title) }}">
                                                @if ($errors->has('title'))
                                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-11">
                                            <div>
                                                <label for="basiInput" class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}">
                                                @if ($errors->has('slug'))
                                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-11">
                                            <label for="basiInput" class="form-label">Chọn ảnh</label>
                                            <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="lfm btn btn-primary" data-input="thumbnail2"
                                                data-preview="holder2" class="btn btn-primary text-white">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </button>
                                    </span>
                                                <input id="thumbnail2" class="form-control" type="text" name="filepath" value="{{$blog->image}}">
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="col-11">
                                            <div>
                                                <label for="exampleFormControlTextarea5" class="form-label">Mô tả ngắn</label>
                                                <textarea class="form-control" name="description_short" rows="3">{{ old('description_short', $blog->description_short) }}</textarea>
                                            </div>
                                            @if ($errors->has('description_short'))
                                                <span class="text-danger">{{ $errors->first('description_short') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-11">
                                            <label class="label-control mb-2">Nội dung</label>
                                            <textarea name="content" id="content" class="d-none my-editor">{!!$blog->content!!}
                                </textarea>
                                            @if ($errors->has('content'))
                                                <span class="text-danger">{{ $errors->first('content') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="col-11">
                                            <div>
                                                <label for="basiInput" class="form-label">Chủ đề</label>
                                                <select name="category_blog_id" class="form-control ">
                                                    @foreach ($category_blogs as $item)
                                                        <option value="{{ $item->id }}" {{ old('category_blog_id', $blog->category_blog_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_blog_id')
                                                <span class="text-danger">{{ $errors->first('category_blog_id') }}</span>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <div class="col-11">--}}
{{--                                            <label class="label-control mb-2">View</label>--}}
{{--                                            <input type="number" class="form-control" name="view" value="{{ old('view', $blog->view) }}" >--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <!--end col-->
                                <br>
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary" >Update</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><a href="{{route('blogs.list')}}" style="color: white">Trở lại</a></button>
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
    <script>
        //Truyền wx liệu sửa vào modal
        const editButtons = document.querySelectorAll('.edit-item-btn');

        editButtons.forEach((button) => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const editForm = document.getElementById('editForm');

                // Tạo URL đến route update với categoryId đã nhận được
                const editUrl = '{{ route("category_blog.update", ":id") }}'.replace(':id', categoryId);

                // Gửi yêu cầu AJAX để lấy dữ liệu của categoryId
                fetch(editUrl)
                    .then(response => response.json())
                    .then(data => {
                        // Gán dữ liệu vào các trường nhập trong modal
                        document.getElementById('name').value = data.name;
                        document.getElementById('slug').value = data.slug;
                        document.getElementById('message-text').value = data.description;

                        // Thiết lập action và method của form trong modal
                        editForm.action = editUrl;
                        editForm.method = 'POST';
                        editForm.insertAdjacentHTML('beforeend', '@method("PUT")');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        //hàm lấy slug ***********8
        function generateSlug() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            // Lấy giá trị từ input name
            const nameValue = nameInput.value.trim();

            // Xử lý chuỗi để tạo slug
            const slugValue = nameValue
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')  // Xóa các ký tự không hợp lệ
                .replace(/-+/g, '-')  // Loại bỏ các dấu gạch ngang liền nhau
                .replace(/^-|-$/g, '');  // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi

            // Gán giá trị vào input slug
            slugInput.value = slugValue;
        }
    </script>
@endsection
