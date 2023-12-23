@extends('layouts.veterinary')
@php
$name = '';
@endphp
@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4> Add Patient</h4>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="fas fa-shopping-cart"></i><span
                                    class="badge badge-danger text-sm cart-count">{{ Cart::count(); }}</span></button>

                            <a href="{{ route('veterinary.medicals.index') }}"
                                class="btn btn-inverse-primary btn-rounded btn-icon">
                                <i class="ti-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    <form class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="lname">Patient Name</label>

                            <select name="animal_id" id="animal"
                                class="@error('animal_id') is-invalid @enderror form-control">
                                <option value="" selected>Select Patien...</option>
                                @foreach ($animal as $item )
                                @if ($item->owner->branch == $vet->branch)
                                <option value="{{ $item->id }}">{{ $item->name . ' - ' .$item->owner->email
                                    }}
                                </option>
                                @endif

                                @endforeach
                            </select>
                            @error('animal_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" id="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('veterinary.medicals.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row mt-3">

            @foreach ($medecine as $item)
            <div class="col-lg-2 grid-margin stretch-card shadow px-2 py-2 mb-2 " style="margin: 0 auto;">
                <div class="product text-center">
                    <h4 class="card-title">{{ Str::ucfirst($item->name) }}</h4>
                    <p class="card-leading">{{ Str::limit($item->description, 100, '...') }}</p>
                    <div class="row mb-2" style="margin: 0 auto">
                        <div class="col inputparent">
                            <input type="hidden" value="{{ Str::lower(Str::camel($item->name)) }}" />
                            <p>
                                @if ($item->quantity > 0)
                                <span class="text-success">Instock</span>
                                @else
                                <span class="text-danger">Out-of-stocks</span>
                                @endif
                                <span id="stock{{ $item->id }}">{{
                                    $item->quantity == '0' ? 0: $item->quantity }}</span>
                            </p>
                            <input type="number" id="qty{{ $item->id }}"
                                name="qty{{  Str::lower(Str::camel($item->name)) }}"
                                class="form-control mb2 {{   Str::lower(Str::camel($item->name)) }}">
                            <div class="invalid-feedback">
                                Required and numeric.
                            </div>
                        </div>
                    </div>

                    <button {{ $item->quantity > 0 ? '' :'disabled' }}
                        class="add-to-cart id{{ Str::lower(Str::camel($item->name)) }} btn btn-sm btn-outline-success"
                        data-product-id="{{ $item->id }}"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Consumptions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <table class="table table-striped table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')


<script>
    $(document).ready(function() {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });



    $(".add-to-cart").click(function(e) {
        var isTrue = false
        let productId = $(this).data('product-id');
        let qty = $(`#qty${productId}`).val();
      if(qty == undefined || qty == 0 || qty < 0){
            $(`#qty${productId}`).addClass("is-invalid")
            console.log(qty);
      }else{
        const stock = $('p').find(`#stock${productId}`).html();

        if(Number(stock) < Number(qty)){
            toastr.warning('Inefficient stocks')
        }else{
            isTrue = true;
            let qty = $(`#qty${productId}`).val();
            var element = document.getElementById(`qty${productId}`);
            element.classList.remove("is-invalid");
            element.setAttribute("disabled", true);
            $(`#qty${productId}`).addClass('is-valid');
            $(`#qty${productId}`).addClass('disabled');



       if(isTrue) {
        $.ajax({
            type: 'POST',
            url: "{{ route('veterinary.storeCart') }}",
            data: { productId: productId, qty: qty },
            success: function(response) {
                const datas = response.data;
                var name = datas['name']
                var oneWord = name.replace(/[^a-zA-Z]/g, '')
                $(`.id${oneWord}`).attr('disabled', true)

                console.log(response.data);
                console.log(response.message);
                $(".cart-count").html("");
                $(".cart-count").html(response.cartCount);
                $(`#qty${productId}`).val("");
                const totals = response.cartTotal;
                console.log(datas);
                $('#tbody').append(` <tr id="tr${datas['rowId']}">
                                        <td>${datas['name']}</td>
                                        <td>${datas['qty']}</td>
                                        <td>
                                            <Button class="btn btn-sm btn-danger btn-delete" data-product-id="${datas['rowId']}">
                                                <i class="fa fa-trash-o"></i>
                                            </Button>
                                        </td>
                                     </tr>

                                            `);


            },
        });
       }
        }

      }



    });

    $('#exampleModal').on('show.bs.modal', function(e) {

            $(".btn-delete").click(function (e) {
                let productId = $(this).data('product-id');
                console.log(productId)
                $(`#tr${productId}`).remove();
            $.ajax({
                type: "POST",
                url: "{{ route('veterinary.delete') }}",
                data: {delete: productId},
                success: function (response) {
                    const totals = response.cartTotal;
                    console.log(response.message)
                    console.log(response.cart)
                    $('#td_totals').html("")
                    $('#td_totals').html(`Totals: ${totals}`)

                    const valuesArray = [];
                    const inputElements = document.querySelectorAll('input[type="hidden"]');
                    inputElements.forEach(input => {
                        valuesArray.push(input.value);
                    });
                    const cartItem = response.item;
                    var oneWord = cartItem.replace(/[^a-zA-Z]/g, '')
                    console.log(oneWord);
                    if (valuesArray.includes(oneWord)) {
                        console.log(response.item);
                        console.log(oneWord);
                        var btn = document.querySelector(`id${oneWord}`);
                      var input =  $(".inputparent").find(`.${oneWord}`);
                      $(input).removeClass('is-valid');
                      $(input).removeAttr("disabled");
                      $(`.id${oneWord}`).attr('disabled', false)
                    }

                }
            });
            });

  })

  $("#exampleModal").on("hidden.bs.modal", function () {
   $.ajax({
    type: "Get",
    url: "{{ route('veterinary.cartCount')  }}",
    success: function (response) {
        $(".cart-count").html("");
        $(".cart-count").html(response.cartCount);

    }
   });
});

$('#submit').click(function (e) {
    e.preventDefault();

    var cart = $('.cart-count').html()
    let animalID =  $('select').val()
    console.log(animalID);
    if(cart == 0 || animalID == undefined) {
        toastr.error('Patient name and items is required.')
    }else{
        var animal =  $('select').val()
        console.log(animal);
        $.ajax({
        type: "POST",
        url: "{{ route('veterinary.vet_consumptions.store') }}",
        data: {id: animal},
        success: function (response) {

            toastr.options = {
                    closeButton: false,
                    debug: false,
                    onclick: null,
                    showDuration: "1000",
                    hideDuration: "1000",
                    timeOut: "2000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };
            toastr.options.onHidden = function () {
                    // this will be executed after fadeout, i.e. 2secs after notification has been show
                    // window.location.href = "/category";
                    window.location.href = "{{ route('veterinary.vet_consumptions.index')}}";

                };
                toastr.success(response.message)
        }
    });
    }




});

});
</script>


@endsection