import express from "express";
import http from "http";
import { Server } from "socket.io";

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: { origin: "*" } // Allow all origins for demonstration purposes
});

io.on("connection", (socket) => {
    console.log("A user connected");

    socket.on("sendCahtToServer", (message) => {
        console.log(message)
        socket.broadcast.emit("sendCahtToServer", (message))
    })

    socket.on("disconnect", () => {
        console.log("User disconnected");
    });
});

const PORT = process.env.PORT || 3000;

server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
