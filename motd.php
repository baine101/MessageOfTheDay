
#!/bin/php-cmd -q

<?php

    // create a new cURL resource
    $ch = curl_init("http://quotes.stormconsultancy.co.uk/random.json");

// set URL and other appropriate options
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
    curl_setopt($ch, CURLOPT_URL, "http://quotes.stormconsultancy.co.uk/random.json"),
    curl_setopt($ch, CURLOPT_HEADER, 'Accept: application/json')
));
// grab URL and pass it to the browser
    $quoteResponse = curl_exec($ch);

    $quoteArr = json_decode($quoteResponse,true);

    $author = "";
    $quote = "";
    foreach ($quoteArr as $key => $value){

        if($key === "author")
            $author = $value;
        if($key === "quote")
            $quote = $value;
    }


    $quote = $quote . " \n -". $author . "\n";
    $quote = wordwrap($quote, 60,"\n", false);

    $motd = fopen("/etc/motd", "w") or die("Unable to open file!");
    fwrite($motd, $quote);
    fclose($motd);
?>

