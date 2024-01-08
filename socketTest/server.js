import express from "express";
import http from "http";
import { Server } from "socket.io";
import { v4 as uuidv4 } from 'uuid';
import axios from "axios";

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: { origin: "*" } // Allow all origins for demonstration purposes
});
const activeUsers = {};
io.on("connection", (socket) => {
    const userId = uuidv4();
    activeUsers[userId] = socket.id;

    socket.on("sendPatientToServer", (response) => {
        let data = JSON.stringify({
            "userToken": response.toDoctor,
            "patientToken": response.patientToken
        });
        console.log(response.baseUrl)
        let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: response.baseUrl + '/dashboard/patientsToDoctor/toDoctor/add',
            headers: {
                'Content-Type': 'application/json'
            },
            data: data
        };

        axios.request(config)
            .then((response) => {
                socket.emit("responsSendToServer", response.data)
                if (response.data.status === 200) {
                    io.emit("sendToDoctor", "good")
                }
            })
    })
    socket.on("disconnect", () => {
    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Server is running sucessfully http://127.0.0.1:${PORT}/`);
});
