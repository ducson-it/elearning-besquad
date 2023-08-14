@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Quản lý chủ đề blog</h3>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('category_blog.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thêm chủ đề blog</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Tên</label>
                                                            <input type="text" class="form-control" id="name" name="name" oninput="generateSlug()">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Slug</label>
                                                            <input type="text" class="form-control" id="slug" name="slug">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Mô tả</label>
                                                            <textarea class="form-control" id="message-text" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="{{ route('category_blog.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="search">
                                            <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                <tr>
                                    <th>Stt</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($category_blogs as $i => $category_blog )
                                    <tr>
                                        <td class="">{{$i+1}}</td>
                                        <td class="">{{$category_blog->name}}</td>
                                        <td class="">{{$category_blog->slug}}</td>
                                        <td class="">{{$category_blog->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <!-- Button trigger modal -->
                                                    <form action="{{ route('category_blog.update',$category_blog->id) }}" method="POST">
                                                        @csrf
                                                    <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$category_blog->id}}">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="staticBackdrop{{$category_blog->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Sửa Category_blog</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="recipient-name" class="col-form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name" oninput="generateSlug()" value="{{$category_blog->name}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="recipient-name" class="col-form-label">Slug</label>
                                                                        <input type="text" class="form-control" id="slug" name="slug" value="{{$category_blog->slug}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="message-text" class="col-form-label">Description</label>
                                                                        <textarea class="form-control" id="message-text" name="description">{{$category_blog->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="deletecategory_blog({{ $category_blog->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                {{$category_blogs->links()}}
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
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
