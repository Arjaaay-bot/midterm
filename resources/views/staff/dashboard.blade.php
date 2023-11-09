
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .container{
        background-color: white;
          box-shadow: 4px 4px 20px #DADADA;
        padding: 10px;
        margin: 10px;
        width: 100%;
  
      }
      @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Apply the animation to the welcome message */
        .welcome-message {
            animation: fadeIn 1.5s ease-in-out;
        }
       
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
@include('staff/sidebar')
              <div class="container">
    <h1 class="welcome-message">Welcome to Your Dashboard</h1>
    <p class="welcome-message">Explore the features and information available to you in this dashboard.</p>
              

                <!-- Content goes here! 😁 -->
        
    
          
        </div>
        
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>



   

