$(function() {
  //hang on event of form with id=myform
  $(".btn-payout").click(function(e) {
      
      e.preventDefault();
      e.stopImmediatePropagation();
      //console.log(this);
      var wid = $(this).attr('data-wid');
      console.log(wid)

      var payment_processor = $('#payment_processor_'+wid).val();
      console.log(payment_processor);

      
      if(payment_processor == 'Payeer'){
        $('#form-send-payment-'+wid).attr('action', "./payeer_payout.php").submit();
      }

      if(payment_processor == 'ADV'){
        $('#form-send-payment-'+wid).attr('action', "./send_adv/adv_sci_payout.php").submit();
      }      

  });
});