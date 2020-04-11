$(document).on("click", ".editClient", () => {
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
  var title = $("#landingpage_title").val();
  var content = $("#landingpage_content").val();
  var address1 = $("#address1").val();
  var address2 = $("#address2").val();
  var city = $("#city").val();
  var postal_code = $("#postal_code").val();
  var province = $("#province").val();
  var phone1 = $("#phone1").val();
  var phone2 = $("#phone2").val();
  var refereeUrl = $("#referee_url").val();
  var referral_css_url = $("#referral_css_url").val();
  var referral_notify_email = $("#referral_notify_email").val();
  var products = [];
  $('#product-group .product-field').each((i, e) => products.push($(e).val()));

  formData.append('clientId', clientId);
  formData.append('company_name', company_name);
  formData.append('unique_name', unique_name);
  formData.append('description', description);
  formData.append('landingpage_title', title);
  formData.append('landingpage_content', content);
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
  formData.append('referee_url', refereeUrl);
  formData.append('referral_css_url', referral_css_url);
  formData.append('referral_notify_email', referral_notify_email);
  formData.append('products', JSON.stringify(products));

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
