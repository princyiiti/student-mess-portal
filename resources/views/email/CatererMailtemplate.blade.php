<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greetings from Dining Office</title>
</head>
<body>
<h2>Greetings from Dining Office</h2>
<h3>M/s {{$Rebate->mess_name}}</h2>
<p>Please be informed that Mr.{{$data->name}} email ID {{$data->email}} will not be using your dining services from {{$Rebate->from_date}} to {{$Rebate->to_date}}.</p>
<h4>For any queries, clarifications or assistance feel free to contact dining office IIT Indore</h4>
<br>
<p>आपको सूचित किया जाता है कि श्री {{$data->name}} ईमेल आईडी {{$data->email}}, दिनांक {{$Rebate->from_date}} से {{$Rebate->to_date}} तक आपकी भोजन सेवाओं का उपयोग नहीं करेंगे | .</p>
<h4>आपसे अनुरोध है कि इस सम्बन्ध में किसी भी प्रकार की सहायता, अनुरोध एवं प्रश्र के लिए आई आई टी , इंदौर के भोजन संबंधी कार्यालय में संपर्क करें|</h4>
<h3>Best Regards</h3>
<h3>Dining Office<br>IIT Indore</h3>
</body>
</html>