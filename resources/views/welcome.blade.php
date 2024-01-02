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
    <input type="text" id="recipientUserId" placeholder="Recipient User ID">
    <input type="text" id="message" placeholder="Message">
    <button id="sendMessageButton">Send Message</button>
    <ul id="ul">

    </ul>
    <script>
        $(function() {
            let ipAddress = "192.168.100.201";
            let socketPort = "3001";
            let socket = io(ipAddress + ":" + socketPort);
            document.getElementById("sendMessageButton").addEventListener("click", () => {
                const recipientUserId = document.getElementById("recipientUserId").value;
                const message = document.getElementById("message").value;
                console.log("je;;p")
                // Emit the event with user ID, recipient user ID, and message
                socket.emit("sendChatToServer", {
                    recipientUserId,
                    message
                });
            });
            socket.on("sendChatToServer", (data) => {
                $("#ul").append(`<li> Received message from user  to ${data.recipientUserId}: ${data.message} </li>`)
                // alert(`Received message from user  to ${data.recipientUserId}: ${data.message}`)
                // console.log();
                // Handle the received message as needed
            });
        })
    </script>
</body>


</html>