$(document).on("click", ".toggleClosedClient", function() {
  let referralId = $(this).attr('data-referral-id');

  $.ajax({
    url: `/client/referrals/${referralId}`,
    type: 'PUT',
    dataType: 'json',
    data: {
      closed: this.checked
    },
  });
});
