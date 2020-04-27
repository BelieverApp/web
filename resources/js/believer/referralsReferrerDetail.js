$(document).on("change", ".detail-customer-affiliation", function() {
  let referrerId = $(this).attr('data-referrer-id');

  $.ajax({
    url: `/admin/referrers-active/${referrerId}`,
    type: 'PUT',
    dataType: 'json',
    data: {
      affiliation: parseInt(this.value)
    },
  });
});
