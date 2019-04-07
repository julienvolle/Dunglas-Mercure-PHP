<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Server</title>
        <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <div class="jumbotron py-4 my-4">
                <h1 class="display-4 mb-4">Dunglas/Mercure</h1>
                <p class="lead">Server</p>
            </div>
            <button id="all" class="btn btn-warning" type="button" role="button">Notify all clients</button>
            <button id="c1" class="btn btn-warning" type="button" role="button">Notify client #1</button>
            <button id="c2" class="btn btn-warning" type="button" role="button">Notify client #2</button>
            <button id="c3" class="btn btn-warning" type="button" role="button">Notify client #3</button>
        </div>

        <script type="text/javascript">
            function ping(id = 0) {
                let service = (id !== 0 ? '/ajax/ping.php?id=' + id : '/ajax/ping.php');
                let request = new XMLHttpRequest();
                request.onreadystatechange = function(){
                    if (request.readyState == 4 && request.status !== 200){
                        console.log('ReadyState: ' + request.readyState);
                        console.log('Status: ' + request.status);
                        console.log('ResponseText: ' + request.responseText);
                    }
                }
                request.open('POST', service, true);
                request.send();
            }
            document.getElementById('all').onclick = () => ping();
            document.getElementById('c1').onclick = () => ping(1);
            document.getElementById('c2').onclick = () => ping(2);
            document.getElementById('c3').onclick = () => ping(3);
        </script>

    </body>
</html>