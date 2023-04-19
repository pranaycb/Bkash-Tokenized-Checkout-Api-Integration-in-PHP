<?php include_once "./config.php"; ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bKash Payment Gateway</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div class="t-center">
        <input type="number" name="amount" placeholder="Enter payment amount" />
        <br/><br />
        <button id="submit">Pay With bKash</button>
    </div>

    

    <script>

    	$(document).ready(function() {

    		$.ajax({
    		  url: './grand-token.php',
    		  type: 'GET',
    		  contentType: 'application/json',
    		  success: function(result) {
    		    
    		  	console.log(result);

    		  },
    		});
    		
    	});


    	$('#submit').click(function(event) {

            const amount = $('input[name="amount"]').val();

    		$.ajax({
    		  url: './create-payment.php',
    		  type: 'POST',
              data: {
                amount
              },
              success: function(result) {
    		    
    		  	location.href = result;
    		  },
    		});

    	});
    </script>

</body>
</html>