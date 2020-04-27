$(document).on("change", ".client-detail-customer-affiliation", function() {
  let referrerId = $(this).attr('data-referrer-id');

  $.ajax({
    url: `/client/referrers-active/${referrerId}`,
    type: 'PUT',
    dataType: 'json',
    data: {
      affiliation: parseInt(this.value)
    },
  });
});
