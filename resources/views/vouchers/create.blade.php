@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tạo voucher</h4>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('store.voucher')}}" method="post">
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center row">
                                <div class="col">
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Tên voucher</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{old('name')}}" placeholder=" Tên voucher ">
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
                                                   value="{{old('code')}}" placeholder="nhập mã code voucher">
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <label class="form-label">Đơn vị</label>
                                        <div>
                                            <select name="unit" class="form-control" id="unit-select">
                                                <option value="Percent">Phần trăm</option>
                                                <option value="VND">Số tiền được giảm (VND)</option>
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
                                        <div class="row">
                                            <div class="col">
                                                <!-- Input phần trăm -->
                                                <input type="number" min="0" max="100" name="percentage_value" value="{{old('percentage_value')}}" id="percentage_value" class="form-control percentage-input " placeholder="Nhập mức từ 0 -> 100 (%)" disabled>
                                                @error('percentage_value')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <!-- Input giảm giá VND -->
                                                <input type="number" min="0" name="vnd_value" id="vnd_value"  value="{{old('vnd_value')}}" class="form-control vnd-input " placeholder="Nhập số tiền giảm giá (VND)" disabled>
                                                @error('vnd_value')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Ngày hết hạn</label>
                                            <input type="date" name="expired"
                                                   class="form-control @error('expired') is-invalid @enderror"
                                                   value="{{old('expired')}}" placeholder="Ngày hết hạn">
                                            @error('expired')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <label for="basicInput" class="form-label">Số lượng áp dụng</label>
                                        <div>
                                            <input type="radio" name="option" value="infinity" id="radio1"> Vô hạn
                                            <input type="radio" style="margin-left: 20px" name="option" value="limited" id="radio2"> Giới hạn số lượng
                                            <div id="div1" class="bg-success rounded p-2" style="display: none;">
                                                Bạn đã lựa chọn voucher có số lượng vô hạn cho tất cả user trong hệ thống.
                                            </div>
                                            <div id="div2" class=" " style="display: none;">
                                                <input type="number" name="quantity" class="form-control p-2" style="padding-top: 10px" placeholder="nhập số lượng">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                        <button type="button" class="btn btn-primary">
                                            <a style="color: white" href="{{route('show.voucher')}}">trở về</a>
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
        // Lấy tham chiếu đến các radio buttons và divs
        const radio1 = document.getElementById('radio1');
        const radio2 = document.getElementById('radio2');
        const div1 = document.getElementById('div1');
        const div2 = document.getElementById('div2');
        const quantityInput = document.querySelector('#div2 input[type="number"]');

        // Hàm để hiển thị lỗi
        function showError() {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger';
            errorDiv.textContent = 'Vui lòng nhập số lượng.';
            div2.appendChild(errorDiv);
        }

        // Hàm để xóa lỗi
        function removeError() {
            const errorDiv = div2.querySelector('.text-danger');
            if (errorDiv) {
                div2.removeChild(errorDiv);
            }
        }

        // Hàm để kiểm tra và hiển thị div tương ứng khi trang tải lại
        function displayDivOnLoad() {
            if (localStorage.getItem('radioChecked') === 'radio1') {
                radio1.checked = true;
                div1.style.display = 'block';
                div2.style.display = 'none';
            } else if (localStorage.getItem('radioChecked') === 'radio2') {
                radio2.checked = true;
                div2.style.display = 'block';
                div1.style.display = 'none';
            } else {
                div1.style.display = 'none';
                div2.style.display = 'none';
            }
            // Kiểm tra và hiển thị lỗi validate khi trang tải lại
            if (radio2.checked && quantityInput.value.trim() === '') {
                showError();
            }
        }

        // Gọi hàm khi trang tải lại
        window.addEventListener('load', displayDivOnLoad);

        // Thêm sự kiện change vào cả hai radio buttons
        radio1.addEventListener('change', function () {
            localStorage.setItem('radioChecked', 'radio1');
            div1.style.display = 'block';
            div2.style.display = 'none';
            removeError();
        });

        radio2.addEventListener('change', function () {
            localStorage.setItem('radioChecked', 'radio2');
            div2.style.display = 'block';
            div1.style.display = 'none';
            removeError();
        });

        // Thêm sự kiện input vào input số lượng để bắt validate
        quantityInput.addEventListener('input', function () {
            if (radio2.checked && quantityInput.value.trim() === '') {
                showError();
            } else {
                removeError();
            }
        });

        // Xóa LocalStorage khi submit form (đảm bảo các radio button mở và đóng đúng khi tải lại trang sau khi submit)
        document.querySelector('form').addEventListener('submit', function () {
            localStorage.removeItem('radioChecked');
        });

    </script>

@endsection
