import express from "express";
import http from "http";
import { Server } from "socket.io";
import axios from "axios";
import { v4 as uuidv4 } from 'uuid';

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: { origin: "*" } // Allow all origins for demonstration purposes
});
const activeUsers = {};
io.on("connection", (socket) => {
    const userId = uuidv4(); // Generate a unique user ID
    socket.emit("setUserId", userId);
    activeUsers[userId] = socket.id;
    console.log(`User connected: ${userId}`);

    socket.on("sendChatToServer", (data) => {
        console.log(data)
        const { recipientUserId, message } = data;
        const recipientSocketId = activeUsers[recipientUserId];
        if (recipientSocketId) {
            io.to(recipientSocketId).emit("sendChatToServer", { senderUserId: userId, message });
        }
        socket.broadcast.emit("sendChatToServer", { senderUserId: userId, message });
    });

    socket.on("disconnect", () => {
        console.log("User disconnected");
    });
});

const PORT = process.env.PORT || 3001;

server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
