@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa voucher</h4>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('update.voucher',$voucher->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row gy-4 d-flex justify-content-center row">
                                <div class="col">
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Tên voucher</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="<?= $voucher->name ?>" placeholder=" Tên voucher ">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Mã code</label>
                                            <input type="text" name="code"
                                                   class="form-control @error('code') is-invalid @enderror"
                                                   value="<?= $voucher->code  ?>" placeholder="nhập mã code voucher">
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <label class="form-label">Đơn vị</label>
                                        <div>
                                            <select name="unit" class="form-control" id="unit-select">
                                                <option <?= $voucher->unit == 'Percent' ? 'selected': '' ?> value="Percent">Phần trăm</option>
                                                <option <?= $voucher->unit == 'VND' ? 'selected': '' ?> value="VND">Số tiền được giảm (VND)</option>
                                            </select>
                                            @error('unit')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col-11 mt-3">
                                        <label class="form-label">Giảm giá</label>
                                        <div>
                                            <!-- Input phần trăm -->
                                            <input type="number" min="0" max="100" value="<?= $voucher->unit == 'Percent' ? $voucher->value: '' ?>" name="percentage_value" id="percentage_value" class="form-control percentage-input " placeholder="Nhập mức giảm giá từ 0 -> 100 phần trăm" disabled>
                                            @error('percentage_value')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <!-- Input giảm giá VND -->
                                            <input type="number" min="0" name="vnd_value" value="<?= $voucher->unit == 'VND' ? $voucher->value: '' ?>" id="vnd_value" class="form-control vnd-input " placeholder="Nhập số tiền giảm giá(VND)" disabled>
                                            @error('vnd_value')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Ngày hết hạn</label>
                                            <input type="date" name="expired" value="<?= $voucher->expired ?>"
                                                   class="form-control @error('expired') is-invalid @enderror"
                                                   value="{{old('expired')}}" placeholder="Ngày hết hạn">
                                            @error('expired')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <label for="basiInput" class="form-label">Số lần sử dụng</label>
                                        <div>
                                            <select name="is_infinite" class="form-control">
                                                <option <?= $voucher->is_infinite == false ? 'selected': '' ?>  value="0">Giới hạn dùng 1 lần</option>
                                                <option <?= $voucher->is_infinite == true ? 'selected': '' ?>  value="1">Vô hạn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                        <button type="button" class="btn btn-primary">
                                            <a style="color: white" href="{{route('show.voucher')}}">Danh sách</a>
                                        </button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const unitSelect = document.getElementById("unit-select");
            const vndValueInput = document.getElementById("vnd_value");
            const percentageValueInput = document.getElementById("percentage_value");

            let hasInteracted = false; // Biến để kiểm tra xem người dùng đã tương tác với input hay chưa

            function enableVndValueInput() {
                vndValueInput.removeAttribute("disabled");
                percentageValueInput.setAttribute("disabled", "disabled");
                percentageValueInput.value = '';
            }

            function enablePercentageValueInput() {
                vndValueInput.setAttribute("disabled", "disabled");
                vndValueInput.value = '';
                percentageValueInput.removeAttribute("disabled");
            }

            unitSelect.addEventListener("change", function() {
                hasInteracted = false; // Reset biến hasInteracted khi người dùng thay đổi select

                if (unitSelect.value === "VND") {
                    enableVndValueInput();
                } else if (unitSelect.value === "Percent") {
                    enablePercentageValueInput();
                }

                // Validate các input khi người dùng thay đổi unit
                validateInputs();
            });

            // Khi trang được tải lần đầu, cần gọi hàm enableVndValueInput hoặc enablePercentageValueInput để khóa input không phù hợp.
            if (unitSelect.value === "VND") {
                enableVndValueInput();
            } else if (unitSelect.value === "Percent") {
                enablePercentageValueInput();
            }

            // Thêm sự kiện 'input' để kiểm tra và thêm class 'is-invalid' khi người dùng nhập dữ liệu
            vndValueInput.addEventListener("input", function() {
                hasInteracted = true;
                validateInputs();
            });
            percentageValueInput.addEventListener("input", function() {
                hasInteracted = true;
                validateInputs();
            });
            // Kiểm tra giá trị hiện tại của input khi người dùng gửi form
            document.querySelector('form').addEventListener('submit', function(event) {
                const unitSelect = document.getElementById("unit-select");
                const vndValueInput = document.getElementById("vnd_value");
                const percentageValueInput = document.getElementById("percentage_value");

                if (unitSelect.value === "VND") {
                    if (!vndValueInput.value) {
                        vndValueInput.classList.add("is-invalid");
                        event.preventDefault(); // Ngăn form được gửi đi nếu input không hợp lệ
                    } else {
                        vndValueInput.classList.remove("is-invalid");
                    }
                    percentageValueInput.classList.remove("is-invalid");
                } else if (unitSelect.value === "Percent") {
                    if (!percentageValueInput.value) {
                        percentageValueInput.classList.add("is-invalid");
                        event.preventDefault(); // Ngăn form được gửi đi nếu input không hợp lệ
                    } else {
                        percentageValueInput.classList.remove("is-invalid");
                    }
                    vndValueInput.classList.remove("is-invalid");
                }
            });
        });

        function validateInputs() {
            const unitSelect = document.getElementById("unit-select");
            const vndValueInput = document.getElementById("vnd_value");
            const percentageValueInput = document.getElementById("percentage_value");

            if (hasInteracted) {
                if (unitSelect.value === "VND") {
                    if (!vndValueInput.value) {
                        vndValueInput.classList.add("is-invalid");
                    } else {
                        vndValueInput.classList.remove("is-invalid");
                    }
                    percentageValueInput.classList.remove("is-invalid");
                } else if (unitSelect.value === "Percent") {
                    if (!percentageValueInput.value) {
                        percentageValueInput.classList.add("is-invalid");
                    } else {
                        percentageValueInput.classList.remove("is-invalid");
                    }
                    vndValueInput.classList.remove("is-invalid");
                }
            }
        }
    </script>

@endsection
