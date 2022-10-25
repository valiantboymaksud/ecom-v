@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/price-range.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="price-range-slider">
                    <p class="range-value">
                        <input type="text" id="amount" readonly>
                    </p>
                    <div id="slider-range" class="range-bar"></div>

                </div>
            </div>
            <div class="col-3">
                <select name="status" id="status" class="form-control select2" data-placeholder="--Status--"
                    onchange="loadProduct(0)">
                    <option value=""></option>
                    <option value="1">Active</option>
                    <option value="0">InActive</option>
                </select>
            </div>
            <div class="col-3">
                <div class="btn-group">
                    <button class="btn btn-outline-success" onclick="loadProduct(0)">Filter</button>
                    <button class="btn btn-outline-danger" onclick="loadProduct(1)">Refresh</button>
                </div>
            </div>
        </div>
        <div class="row products">

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            loadProduct()
        })

        function loadProduct(refresh = 0) {
            let data = {}
            if (refresh == 0) {
                data = {
                    price: $('#amount').val(),
                    status: $('#status').val()
                };
            }
            $.ajax({
                url: '/api/products',
                method: 'get',
                headers: {
                    'Authorization': 'Bearer ' + auth_token,
                },
                data: data,
                success: function(response) {
                    let res = response.data;
                    $('.products').html(res);

                }
            })
        }
    </script>



    <script>
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: {{ $min }},
                max: {{ $max }},
                values: [{{ $min }}, {{ $max }}],
                slide: function(event, ui) {
                    $("#amount").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        })
    </script>




    <script>
        function delete_item(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/api/products/'+id,
                        method: 'delete',
                        headers: {
                            'Authorization': 'Bearer ' + auth_token,
                        },
                        data: {
                            _token:'{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            loadProduct(0)
                            }

                        }
                    })

                }
            })

        }
    </script>
@endsection
