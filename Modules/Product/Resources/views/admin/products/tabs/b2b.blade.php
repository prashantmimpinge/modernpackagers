{{ Form::checkbox('b_2_b', trans('product::attributes.b_2_b'), trans('Make product B2B'), $errors, $product, ['labelCol' => 2]) }}


{{ Form::number('discount', trans('product::attributes.discount'), $errors, $product, ['labelCol' => 2]) }}


{{ Form::number('pMinQty', trans('product::attributes.pMinQty'), $errors, $product, ['labelCol' => 2]) }}


@php
    // Extract the product ID from the URL
    $url = url()->current();
    $segments = explode('/', $url);
    $id = $segments[count($segments) - 2] ?? null;

    // Initialize the selected user ID
    $selectedUserId = null;

    // Check if product ID is available
    if ($id) {
        $product = DB::select("SELECT users FROM products WHERE id = ?", [$id]);
        if (!empty($product)) {
            $selectedUserId = $product[0]->users; // Access the users property
        }
    }

    // Fetch all users
    $users = DB::select('SELECT * FROM users');
@endphp

<div class="form-group">
    <label for="customer" class="col-md-2 control-label text-left">Customer</label>
    <div class="col-md-10">
        <select name="users" id="users" class="form-control all-users">
            @foreach ($users as $user)
                <option class="one-cust" value="{{ $user->id }}" {{ $user->id == $selectedUserId ? 'selected' : '' }}>
                    {{ $user->id }}&nbsp;&nbsp; - &nbsp;&nbsp;{{ $user->first_name }}&nbsp;{{ $user->last_name }}&nbsp;&nbsp; - &nbsp;&nbsp;{{ $user->email }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function(){
            var select = $('#users');
            var searchInput = $('<input type="text" class="form-control" placeholder="Search..." />');
            select.before(searchInput);

            // Get options and sort them alphabetically
            var options = select.find('option').sort(function(a, b) {
                return $(a).text().localeCompare($(b).text());
            });

            // Replace options in select with sorted options
            select.html(options);

            // Add keyup event listener on the search input
            searchInput.on('keyup', function() {
                var value = $(this).val().toLowerCase(); // Get the search value
                select.find('option').each(function() {
                    var text = $(this).text().toLowerCase();
                    var match = text.includes(value);
                    $(this).toggle(match);
                });
            });
        }, 1000);
    });
</script>
