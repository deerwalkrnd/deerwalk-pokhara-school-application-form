<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Applicant Alert</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div style=" background-color:white; color: black; font-size: 16px; font-family:'Times New Roman', Times, serif; ">
        <p>Dear Admin,</p>
        <p>A new applicant has applied for admission for Deerwalk Pokhara School through DPS online form.<br/>
        <br/>Please find the details in the pdf attachment below,
        </p>
        <p>Best regards,<br>Deerwalk Pokhara School</p>
        {{-- <img src= {{$message->embed(public_path('assets/icons/DPS_new.png'))}} alt="DPS Logo" style="width:180px; height:60px; object:contain;"> --}}
        <p>--</p>
        <p>Pokhara School, Pokhara, Nepal. <br>
        <span style="color:lightgreen">Contact:</span> 061589171, 061586045 <br>
        <a href="https://dps.deerwalk.edu.np/">dps.deerwalk.edu.np</a></p>
    </div>
</body>
</html>