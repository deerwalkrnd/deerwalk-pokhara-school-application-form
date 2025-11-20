<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex w-full h-screen justify-center items-center flex-col border border-black gap-10">
        <img src="{{ asset('assets/icons/DPS_new.png') }}" alt="Image Preview" width="240" height="240"/>
        <div class="text-4xl font-bold max-w-96 text-center leading-2">Your Application has been submitted successfully!</div>
        <a href="https://dps.deerwalk.edu.np/" class="px-6 py-4 text-white font-semibold text-xl transition-all duration-150 ease-in-out
          bg-gradient-to-br from-[#21AA8C] to-[#1A8F76]
          hover:bg-gradient-to-br hover:from-white hover:to-white
          hover:text-[#21AA8C] hover:outline hover:outline-[#21AA8C]
          hover:scale-105">Home Page
        </a>
    </div> 
</body>
</html>