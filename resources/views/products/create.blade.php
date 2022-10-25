@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form action="" id="product-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Type name">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="number" name="price" id="price" class="form-control"
                                    placeholder="Type Price">
                                <label for="floatingInput">Price</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="number" name="offer_price" id="offer_price" class="form-control"
                                    placeholder="Type Offer Price">
                                <label for="floatingInput">Offer Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="variation">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group mb-3">
                                    <select name="attribute_ids[]" class="form-control select2 attribute_id"
                                        data-placeholder="Select Variation">
                                        <option value=""></option>
                                        @foreach ($attributes ?? [] as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 att-obj">
                                <div class="form-group mb-3">
                                    <select name="attribute_object_ids[]" class="form-control select2 attribute_object_id"
                                        multiple>
    
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <button class="btn-sm btn-outline-info" type="button" id="add_more">+</button>
                            </div>
                        </div>
                    </div>



                    <div class="form-group mb-3">
                        <input type="file" name="image" class="form-control" placeholder="Type Offer Price">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-success" id="save-btn" type="submit">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        $(document).on('change', '.attribute_id', function() {
            let selector = $(this).parents('.row').children('.att-obj').find('.attribute_object_id');
            $.ajax({
                url: '/api/attribute-objects?attribute_id=' + $(this).val(),
                method: 'get',
                headers: {
                    'Authorization': 'Bearer ' + auth_token,
                    'Content-Type': 'application/json'
                },
                success: function(res) {
                    selector.empty();
                    res.map(function(item) {
                        selector.append(
                            `<option value="${item.id}">${item.name}</option>`);
                    })
                    $('.select2').select2();
                }
            })

        })
    </script>



    <script>
        // $(document).on('click', '#save-btn', saveProduct)
        $(document).on('submit', '#product-form', saveProduct)
        $(document).on('click', '#add_more', addVariation)
        $(document).on('click', '.delete-item', removeItem)
        const addMoreBtn = $('.variation')

        const name = $('#name')
        const description = $('#description')
        const price = $('#price')
        const offer_price = $('#offer_price')

        function saveProduct(e) {
          e.preventDefault();
            if (name.val() == '') {
                error('Please enter name.')
                return;
            }

            if (price.val() == '') {
                error('Please enter price.')
                return;
            }
            // console.log($(this).serialize());
            $.ajax({
                url: '/api/products',
                method: 'post',
                data: new FormData(this),
                processData:false,
                contentType:false,
                headers: {
                    'Authorization': 'Bearer ' + auth_token,
                },
                success: function(res) {
                  if (res.status) {
                    success('Product added success');
                    window.location = '/products';
                  }
                }
            })
        }

        function addVariation() {
            let row=`<div class="row">
                            <div class="col-5">
                                <div class="form-group mb-3">
                                    <select name="attribute_ids[]" class="form-control select2 attribute_id"
                                        data-placeholder="Select Variation">
                                        <option value=""></option>
                                        @foreach ($attributes ?? [] as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 att-obj">
                                <div class="form-group mb-3">
                                    <select name="attribute_object_ids[]" class="form-control select2 attribute_object_id"
                                        multiple>
    
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <button class="btn-sm btn-outline-info delete-item" type="button"><b>-</b></button>
                            </div>
                        </div>`
                        addMoreBtn.append(row)
                        $('.select2').select2()

        }


        function removeItem() {
            $(this).closest('.row').remove()
        }


    </script>
@endsection
