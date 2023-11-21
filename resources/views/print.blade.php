<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    @vite(['resources/js/app.js'])
</head>

<body class="font-Poppins">
    <div class="container mx-auto">
        <div class="flex justify-center items-center h-screen">
            <div class="text-center">
                <h2 class="font-semibold text-5xl mt-8">
                    {{ strtoupper($last_name) }}
                </h2>
                <h2 class="font-semibold text-5xl">
                    {{ strtoupper($first_name) }}
                </h2>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
        window.print();
    });

    // redirect back to the previous route when printer dialog closes
    window.onafterprint = () => {
        setTimeout(() => {
            location.href = '{{ url()->previous() }}';
        }, 300);
    };
</script>

</html>
