<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>test socket</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<style>
    .chatRow {
        margin: 50px;
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    ul li {
        padding: 8px;
        background-color: #928787;
        margin-bottom: 20px;
    }

    .chatInput {
        border: 1px solid black;
    }
</style>

<body>
    <div class="container">
        <div class="row chatRow">
            <div class="chatContent">
                <ul>
                    <li>test</li>
                </ul>
            </div>
            <div class="chatSection">
                <div class="chatBox">
                    <div class="chatInput bg-white" id="chatInput" contenteditable=""></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            let ipAddress = "z";
            let socketPort = "3000";
            let socket = io(ipAddress + ":" + socketPort);
            chatInput = $("#chatInput");
            chatInput.keypress(function(e) {
                message = $(this).html();
                console.log(message)
                if (e.which === 13 && !e.shiftkey) {
                    socket.emit("sendCahtToServer", message)
                    chatInput.html("");
                    return false;
                }
            });
            socket.on("sendCahtToServer", (message) => {
                alert(message)
                // $(".chatContent ul").append('<li>' + message + '</li>')
            })
        })
    </script>
</body>


</html>