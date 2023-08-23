<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greetings from Dining Office</title>
</head>
<body>
<h2>Greetings from Dining Office</h2>
<h3>M/s <?php echo e($Rebate->mess_name); ?></h2>
<p>Please be informed that Mr.<?php echo e($data->name); ?> email ID <?php echo e($data->email); ?> will not be using your dining services from <?php echo e($Rebate->from_date); ?> to <?php echo e($Rebate->to_date); ?>.</p>
<h4>For any queries, clarifications or assistance feel free to contact dining office IIT Indore</h4>
<br>
<p>आपको सूचित किया जाता है कि श्री <?php echo e($data->name); ?> रोल नंबर <?php echo e($data->email); ?>, दिनांक <?php echo e($Rebate->from_date); ?> से <?php echo e($Rebate->to_date); ?> तक आपकी भोजन सेवाओं का उपयोग नहीं करेंगे | .</p>
<h4>आपसे अनुरोध है कि इस सम्बन्ध में किसी भी प्रकार की सहायता, अनुरोध एवं प्रश्र के लिए आई आई टी , इंदौर के भोजन संबंधी कार्यालय में संपर्क करें|</h4>
<h3>Best Regards</h3>
<h3>Dining Office<br>IIT Indore</h3>
</body>
</html>