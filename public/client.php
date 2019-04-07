<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Client <?= isset($_GET['id']) ? '#' . strip_tags($_GET['id']) : ''; ?></title>
        <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <div class="jumbotron py-4 my-4">
                <h1 class="display-4 mb-4">Dunglas/Mercure</h1>
                <p class="lead">Client <?= isset($_GET['id']) ? '#' . strip_tags($_GET['id']) : ''; ?></p>
            </div>
            <div id="notify">
                <h5 class="display-5 text-muted">Wait notify...</h5>
            </div>
        </div>

        <script type="text/javascript">
            const url = new URL('http://localhost:3000/hub');
            url.searchParams.append('topic', 'http://localhost:8080/ping');
            <?php if (isset($_GET['id'])) { ?>
            url.searchParams.append('topic', 'http://localhost:8080/ping/<?= strip_tags($_GET['id']); ?>');
            <?php } ?>
            const originTitle = document.title;
            let countNotify = 0;
            const eventSource = new EventSource(url);
            eventSource.onmessage = e => {
                countNotify++;
                document.title = originTitle + ' (' + countNotify + ')';
                document.getElementById('notify').insertAdjacentHTML('afterend', '<div class="alert alert-success">Ping!</div>');
                window.setTimeout(() => {
                    const $alert = document.querySelector('.alert');
                    $alert.parentNode.removeChild($alert);
                }, 2000);
            }
        </script>

    </body>
</html>