<form id="t2" method="POST"
	action="http://166.78.8.98/cgi-bin/aries.cgi?sandbox=1&direct=1&returnurl=http://166.78.8.98/cgi-bin/return.htm&cancelurl=http://166.78.8.98/cgi-bin/cancel.htm">
</form>

<script type="text/javascript">
   window.paypalCheckoutReady = function () {
       paypal.checkout.setup('sandbox@2gom.com.mx', {
           container: 't2',
           environment: 'sandbox'
       });
   };
   </script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>