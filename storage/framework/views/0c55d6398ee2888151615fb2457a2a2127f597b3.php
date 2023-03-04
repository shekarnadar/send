<?php
$urlPrefix = urlPrefix();
?>
<script>
    // toaster common function
    function message(action, message) {
        if (action == 'success') {
            // toastr.remove();
            // toastr.options.closeButton = true;
            // toastr.success(message, {
            //     timeOut: 1500
            // });
        } else {
            // toastr.remove();
            // toastr.options.closeButton = true;
            // toastr.error(message, {
            //     timeOut: 1500
            // });
        }
    }

    // common function for page loader on page load
    function pageSpinnerLoader(type, id) {
        if (type === 'show') {
            $('#' + id).html('<div class="content-loader text-center"><i class="fa fa-spin fa-spinner"></i></div>');
        } else {
            $('#' + id).html('');
        }
    }

    // common function for buttonLoader on button events
    function showButtonLoader(id, text, action) {
        /*parameters : button id , text on button  , button property (disable/enable)*/
        var icon = `<span class="fa fa-spin fa-spinner" style="display: inline-block;"></span>`
        if (action === 'disable') {
            $('#' + id).html(`${text} &nbsp ${icon}`);
            $('#' + id).prop('disabled', true);
        } else {
            $('#' + id).html(text);
            $('#' + id).prop('disabled', false);
        }
    }
</script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-125021779-1', {
        'anonymize_ip': true
    });
</script>


<script>
    $(document).ready(function() {
        $('#country-dd').on('change', function() {
            var idCountry = this.value;
            $("#state-dd").html('');
            $("#city-dd").html('');
            $.ajax({
                url: '<?php echo e(url("$urlPrefix/api/fetch-states")); ?>',
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dd').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state-dd').on('change', function() {
            var idState = this.value;
            $("#city-dd").html('');
            $.ajax({
                url: '<?php echo e(url("$urlPrefix/api/fetch-cities")); ?>',
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dd').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });

    // $('.table').DataTable({
    //     searchDelay: 350
    // });
</script><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/footer.blade.php ENDPATH**/ ?>