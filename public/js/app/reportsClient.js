(() => {
  let filterDateStart = new moment();
  let filterDateEnd = new moment();

  const updateReferralData = () => {
    const rangeOption = $('#filter-date-range').val();
    const product = $('#filter-area').val();
    let startRange = filterDateStart;
    let endRange = filterDateEnd;

    const rangeFunc = ({
      "last_week": () => {
        startRange = moment().startOf('day').subtract(7, 'days');
        endRange = moment().endOf('day');
      },
      "last_month": () => {
        startRange = moment().startOf('day').subtract(1, 'months');
        endRange = moment().endOf('day');
      },
      "last_year": () => {
        startRange = moment().startOf('day').subtract(1, 'years');
        endRange = moment().endOf('day');
      }
    })[rangeOption];

    if (rangeFunc) {
      rangeFunc();
    }

    startRange = startRange.unix();
    endRange = endRange.unix();

    $.ajax({
      url: `/client/reports/referralData?start=${startRange}&end=${endRange}&product=${product}`,
      type: 'GET',
      dataType: 'json',
      success: function(result) {
        $('#unique-visits').text(result.uniqueVisits);
        $('#active-referrers').text(result.activeReferrers);
        $('#influential-referrers').text(result.influentialReferrers);
        $('#successful-referrers').text(result.successfulReferrers);
        $('#referred-visitors').text(result.referredVisitors);
        $('#referred-leads').text(result.referredLeads);
        $('#referred-sales').text(result.referredSales);
        $('#online-referral-rate').text(result.onlineReferralRate);
        $('#lead-conversion-rate').text(result.leadConversionRate);
        $('#sales-stor').text(result.salesConversionRateSTOR);
        $('#sales-slc').text(result.salesConversionRateSLC);
      }
    });
  };

  $('#filter-date-range').change(event => {
    const display = event.target.value === 'custom' ? 'block' : 'none';
    $('#filter-date-range-input-container').css('display', display);

    updateReferralData()
  });

  $('#filter-area').change(() => updateReferralData());

  $('#filter-date-range-input').daterangepicker({
    drops: 'down',
    opens: 'right',
    startDate: new Date(+filterDateStart),
    endDate: new Date(+filterDateEnd),
    maxDate: new Date(),
  }, (start, end, label) => {
    filterDateStart = start.startOf('day');
    filterDateEnd = end.endOf('day');
    updateReferralData();
  });

  updateReferralData();
})();
