$(document).on("click", ".toggleClosed", function() {
  let referralId = $(this).attr('data-referral-id');

  $.ajax({
    url: `/admin/referrals/${referralId}`,
    type: 'PUT',
    dataType: 'json',
    data: {
      closed: this.checked
    },
  });
});
