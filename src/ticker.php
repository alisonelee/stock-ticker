<?php
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL);

    $symbol1 = $_POST['stock1'];
    $symbol2 = $_POST['stock2'];
    $symbol3 = $_POST['stock3'];

    $link = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22".$symbol1."%22%2C%22".$symbol2."%22%2C%22)%0A%09%09&env=http%3A%2F%2Fdatatables.org%2Falltables.env&format=json";
?>
<html>
    <head>
        <title>Stocks</title>
        <script>      
    
            function getStocks() {
                var req = new XMLHttpRequest();
                req.open('GET',<?php echo $link;?>, true);
                req.onload = function(e) {
                    if (req.readyState == 4 && req.status == 200) {
                        if(req.status == 200) {
                            var response = JSON.parse(req.responseText);
                            for (i=0; i<response.query.count; i++) {                      
                                document.querySelector('main').innerHTML = 
                                    response.query.created + " **** " +
                                    response.query.results.quote[i].Symbol +
                                    " - $" +                          
                                response.query.results.quote[i].Bid + "<br>" +
                                    document.querySelector('main').innerHTML ;    
                            }
                        } 
                        else
                        console.log("Error");
                    }     
                }
            req.send(null);
            }
            // Query a Stock Quotes service every 10 seconds
            var timer = setInterval(getStocks, 10000);
        
        </script>
    </head>
    <body>
        <main>
        </main>
    </body>
</html>