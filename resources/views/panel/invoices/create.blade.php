@extends('panel.layouts.master')
@section('title', 'ایجاد پیش فاکتور')
@section('styles')
    <style>
        #products_table input, #products_table select{
            width: auto;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h6>ایجاد پیش فاکتور</h6>
            </div>
            <form action="{{ route('invoices.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-12 mb-4 text-center">
                        <h4>مشخصات خریدار</h4>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="buyer_name">نام شخص حقیقی/حقوقی<span class="text-danger">*</span></label>
                        <input type="text" name="buyer_name" class="form-control" id="buyer_name" value="{{ old('buyer_name') }}">
                        @error('buyer_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="economical_number">شماره اقتصادی<span class="text-danger">*</span></label>
                        <input type="text" name="economical_number" class="form-control" id="economical_number" value="{{ old('economical_number') }}">
                        @error('economical_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="national_number">شماره ثبت/ملی<span class="text-danger">*</span></label>
                        <input type="text" name="national_number" class="form-control" id="national_number" value="{{ old('national_number') }}">
                        @error('national_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="postal_code">کد پستی<span class="text-danger">*</span></label>
                        <input type="text" name="postal_code" class="form-control" id="postal_code" value="{{ old('postal_code') }}">
                        @error('postal_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="phone">شماره تماس<span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="province">استان <span class="text-danger">*</span></label>
                        <select name="province" id="province" class="js-example-basic-single select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                            @foreach(\App\Models\Province::all() as $province)
                                <option value="{{ $province->name }}" {{ old('province') == $province->name ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="city">شهر<span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}">
                        @error('city')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 mb-3">
                        <label for="address">نشانی<span class="text-danger">*</span></label>
                        <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-4 mt-2 text-center">
                        <hr>
                        <h4>مشخصات کالا یا خدمات مورد معامله</h4>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <button class="btn btn-outline-success" type="button" id="btn_add"><i class="fa fa-plus mr-2"></i> افزودن کالا</button>
                        </div>
                        <div class="overflow-auto">
                            <table class="table table-bordered table-striped text-center" id="products_table">
                                <thead>
                                    <tr>
                                        <th>کالا</th>
                                        <th>تعداد</th>
                                        <th>واحد اندازه گیری</th>
                                        <th>مبلغ واحد</th>
                                        <th>مبلغ کل</th>
                                        <th>مبلغ تخفیف</th>
                                        <th>مبلغ اضافات</th>
                                        <th>مبلغ کل پس از تخفیف و اضافات</th>
                                        <th>جمع مالیات و عوارض</th>
                                        <th>خالص فاکتور</th>
                                        <th>حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control" name="products[]" required>
                                            <option value="" disabled selected>انتخاب کنید...</option>
                                            @foreach(\App\Models\Product::all(['id','title']) as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="counts[]" class="form-control" min="1" value="1" required>
                                    </td>
                                    <td>
                                        <select class="form-control" name="units[]">
                                            <option value="number">عدد</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="prices[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="total_prices[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="discount_amounts[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="extra_amounts[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="total_prices_with_off[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="taxes[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="invoice_nets[]" class="form-control" min="0" value="0" readonly>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-floating btn_remove" type="button"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ثبت فرم</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        var products = [];

        @foreach(\App\Models\Product::all(['id','title']) as $product)
            products.push({
                "id": "{{ $product->id }}",
                "title": "{{ $product->title }}",
            })
        @endforeach

        var options_html = '';

        $.each(products, function (i, item) {
            options_html += `<option value="${item.id}">${item.title}</option>`
        })

        $(document).ready(function () {
            // add property
                $('#btn_add').on('click', function () {
                    $('#products_table tbody').append(`
                    <tr>
                    <td>
                        <select class="form-control" name="products[]" required>
                            <option value="" disabled selected>انتخاب کنید...</option>
                            ${options_html}
                        </select>
                    </td>
                <td>
                    <input type="number" name="counts[]" class="form-control" min="1" value="1" required>
                </td>
                <td>
                    <select class="form-control" name="units[]">
                        <option value="number">عدد</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="prices[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="total_prices[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="discount_amounts[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="extra_amounts[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="total_prices_with_off[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="taxes[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" name="invoice_nets[]" class="form-control" min="0" value="0" readonly>
                </td>
                <td>
                    <button class="btn btn-danger btn-floating btn_remove" type="button"><i class="fa fa-trash"></i></button>
                </td>
            </tr>

`);
                })
            // end add property

            // remove property
                $(document).on('click','.btn_remove', function () {
                    $(this).parent().parent().remove();
                })
            // end remove property

            // calc the product invoice
            $(document).on('change', '#products_table select[name="products[]"]', function () {
                CalcProductInvoice(this)
            })
            $(document).on('change', '#products_table input[name="counts[]"]', function () {
                CalcProductInvoice(this)
            })
            // end calc the product invoice
        })

        function CalcProductInvoice(changeable) {
            var index = $(changeable).parent().parent().index()
            let product_id =  $('#products_table select[name="products[]"]')[index].value;
            let count =  $('#products_table input[name="counts[]"]')[index].value;

            $.ajax({
                url: "{{ route('calcProductsInvoice') }}",
                type: 'post',
                data: {
                    'product_id': product_id,
                    'count': count,
                },
                success: function (res) {
                    $('#products_table input[name="prices[]"]')[index].value = res.data.price;
                    $('#products_table input[name="total_prices[]"]')[index].value = res.data.total_price;
                    $('#products_table input[name="discount_amounts[]"]')[index].value = res.data.discount_amount;
                    $('#products_table input[name="extra_amounts[]"]')[index].value = res.data.extra_amount;
                    $('#products_table input[name="total_prices_with_off[]"]')[index].value = res.data.total_price_with_off;
                    $('#products_table input[name="taxes[]"]')[index].value = res.data.tax;
                    $('#products_table input[name="invoice_nets[]"]')[index].value = res.data.invoice_net;
                }
            })
        }

    </script>
@endsection

