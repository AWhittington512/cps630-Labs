<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgEhxoik76va_nhG6KsA4DTa5JBr_Iz0I&callback=initMap"></script>

    <?php
        include "phpScripts/DBConnect.php";
        include "phpScripts/Product.php";
        include "phpScripts/RenderList.php";
    ?>
</head>
<body>
    <?php include 'navbar.html';?>
    <?php include 'storeSelector.html';?>
    <div class="container">
        <h1>Items</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tops">Tops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#outer">Outerwear</a>
            </li>
        </ul>

        <div id="itemList" class="container text-center">
            <?php
                $result = $connection->query("select * from Item");
                $items = [];
                if ($result) {
                    while ($item = $result->fetch_assoc()) {
                        //echo ("{$item['ItemName']}, {$item['ItemPrice']}<br>");
                        $items[] = new Product($item['ItemName'], $item['ItemPrice'], $item['Picture_URL']);
                    }
                }

                $output = "<div class='row align-items-center gap-3'>";
                foreach ($items as $item) {
                    $output .= $item->renderHtml();
                }

                $output .= "</div>";

                echo ($output);
            ?>
        </div>
      </div>
    </div>
</body>

<script>
    async function codeAddress(apiUrl) {
        fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            var city = data.address.city
            var postal = data.address.postcode
            findStores(city, postal)
        })
        .catch(error => {
            document.getElementById('postalCode').innerHTML = "Location not found"
        });
    }

    function findStores(city, postcode) {
        document.getElementById('postalCode').innerHTML = postcode
        switch(city) {
            case 'Toronto':
                document.getElementById('storeLocation').innerHTML = "Queen St W, Toronto"
                break
            case 'Markham': 
                document.getElementById('storeLocation').innerHTML = "CF Markville, Markham"
                break
            case 'Mississauga': 
                document.getElementById('storeLocation').innerHTML = "Square One Shopping Centre, Mississauga"
            default:
                document.getElementById('storeLocation').innerHTML = "No store selected"
        }
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getCoords);
        }
        else {
            alert("Geolocation is not supported by this browser");
        }
    }

    function getCoords(position) {
        var address = position.coords.latitude + ',' + position.coords.longitude;
        var apiUrl = `https://geocode.maps.co/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}`
        codeAddress(apiUrl);
    }
    
    function selectStore() {
        const selectButtons = document.querySelectorAll('.store');

        selectButtons.forEach(button => {
        button.addEventListener('click', () => {
            const storeName = button.closest('.store').querySelector('.store-name').textContent;
            
            document.getElementById('storeLocation').innerHTML = storeName;
        });
        });
    }
</script>

</html>
