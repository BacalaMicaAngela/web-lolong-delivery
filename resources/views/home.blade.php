<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/lts-logo.PNG" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 10px solid #1f5db4;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 17px;
            color: #F8F8F8;
            line-height: 1.6;
        }

        #showcase {
            background-image: url('https://static01.nyt.com/images/2022/04/06/business/00JPtrucker-training2-print/00trucker-training01-superJumbo.jpg?quality=75&auto=webp');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
        }

        #showcase h1 {
            font-size: 50px;
            line-height: 1.2;
        }

        #showcase p {
            font-size: 20px;
        }

        #showcase .button {
            font-size: 18px;
            text-decoration: none;
            color: #F8F8F8;
            border: #F8F8F8 1px solid;
            padding: 10px 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        #showcase .button:hover {
            background: #0d6efd;
            color: #F8F8F8;
        }

        #section-a {
            padding: 20px;
            background: #926239;
            color: #F8F8F8;
            text-align: center;
        }

        #section-b {
            padding: 20px;
            background: #f4f4f4;
            text-align: center;
        }

        #section-c {
            display: flex;
        }

        #section-c div {
            padding: 20px;
        }

        #section-c .box-1,
        #section-c .box-3 {
            background: #926239;
            color: #F8F8F8;
        }

        #section-c .box-2 {
            background: #f9f9f9;
        }

        .text-center.p-6.footer-bg a {
            text-decoration: none !important;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 17px;
            color: #F8F8F8;
            line-height: 1.6;
        }

        .text-center.p-6.footer-bg {
            background: #92623900 !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LTS ( LOLONG TRUCKING SERVICES)</title>
</head>

<body>
    <div id="loader" class="center"></div>
    @yield('contentApplicant')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
        // typing animation
        // var typed = new Typed(".typing", {
        //     strings: ["", "Welcome To LTS (LOLONG TRUCKING SERVICES)"],
        //     typeSpeed: 100,
        //     BackSpeed: 60,
        //     loop: true
        // })
    </script>
</body>

</html>
