$(document).on("click", ".editClient", function() {
    // e.preventDefault();
    console.log("client edit requested");

    var formData = new FormData();

    var clientId = $("#client_id").val();
    var company_name = $("#name").val();
    var unique_name = $("#unique_name").val();
    var description = $("#description").val();
    var fileInput = document.getElementById('clientimage');
    var fileInput2 = document.getElementById('clientimage2');
    var fileInput3 = document.getElementById('bannerimage');
    var logo = fileInput.files[0];
    var logo2 = fileInput2.files[0];
    var banner = fileInput3.files[0];
    var address1 = $("#address1").val();
    var address2 = $("#address2").val();
    var city = $("#city").val();
    var postal_code = $("#postal_code").val();
    var province = $("#province").val();
    var phone1 = $("#phone1").val();
    var phone2 = $("#phone2").val();

    formData.append('clientId', clientId);
    formData.append('company_name', company_name);
    formData.append('unique_name', unique_name);
    formData.append('description', description);
    // formData.append('logo', logo);
    // formData.append('logo2', logo2);
    // formData.append('banner', banner);
    formData.append('address1', address1);
    formData.append('address2', address2);
    formData.append('city', city);
    formData.append('postal_code', postal_code);
    formData.append('province', province);
    formData.append('phone1', phone1);
    formData.append('phone2', phone2);
    if (typeof logo !== 'undefined'){
        formData.append('logo', logo);
    }
    if (typeof logo2 !== 'undefined'){
        formData.append('logo2', logo2);
    }
    if (typeof banner !== 'undefined'){
        formData.append('banner', banner);
    }

    console.log(formData);
    $(this).html("Processing");
    $(this).prop('disabled', true);
    $(this).find('i:first').removeClass("fa-check");
    $(this).find('i:first').addClass("fa-spinner");
    $(this).find('i:first').addClass("fa-spin");

    $.ajax({
        url: '/admin/updateClient',
        type: 'POST',
        //dataType: 'json',
        data: formData,
        success: function(result) {
            swal("Done!", "Client info updated!", "success")
            .then(function() {
                window.location = "/admin/clients/" + result.id;
            });
        },
        cache: false,
        contentType: false,
        processData: false
    });
	return false;
});
