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
    socket.on("connectUser", (response) => {
        let data = JSON.stringify({
            "userName": response.userName,
            "socketId": socket.id
        });
        let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: 'http://localhost/dashboard/users/user/online',
            headers: {
                'Content-Type': 'application/json',
            },
            data: data
        };

        axios.request(config)
            .then((response) => {
                console.log(response)
            }).then(() => {
                let configs = {
                    method: 'get',
                    maxBodyLength: Infinity,
                    url: 'http://localhost/dashboard/users/getAllAdminUsers',
                    headers: {
                        'Cookie': 'laravel_session=eyJpdiI6IkxFR29sb0p0UkZCOUltUEVJeWQzTFE9PSIsInZhbHVlIjoiUTUwTE5pN1N2K09XSE1UR3Y3ZGpxZjlpVmRwVEtFMUVJY0x0WVZ2R1ZSb3BlNTZESGJjNEZnaFduRzVtMk1jTzV0cGllazhFTDhmMC9MQmFSaXpaRjhSd1FHL1ZYemtjcUN0RDFXZDllZ3E0TEtsUndCWmpyTzdvbHExM0UrWHYiLCJtYWMiOiI3ODFmNDdjN2IxNzQ4YjU2NjAzOWRjNTZiNjUzNjExNjE3YTE3ZWM3MmU3MmY1MDU2ZmUxYjMzOGRjN2Y2ZmViIiwidGFnIjoiIn0%3D'
                    }
                };
                var table;
                axios.request(configs)
                    .then((response) => {
                        console.log(response)
                        var dataTable = response.data.data;
                        dataTable.forEach(element => {
                            table += `<tr>
                                <th>${element.userName}</th>
                                <th>${element.isOnline}</th>
                                <th>
                                    <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                        <font class="tn-in-text">View</font>
                                    </button>
                                    <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                        <font class="tn-in-text">File</font>
                                    </button>
                                    <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                        <font class="tn-in-text">Pdf</font>
                                    </button>
                                    <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                        <font class="tn-in-text">Reject</font>
                                    </button>
                                </th>
                            </tr>`;
                        });
                    }).then(() => {
                        io.emit("getTable", {
                            "html": table,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            })
            .catch((error) => {
                console.log(error);
            });

    })
    socket.on("disconnect", () => {
        // let data = JSON.stringify({
        //     "socketId": socket.id
        // });
        // let config = {
        //     method: 'post',
        //     maxBodyLength: Infinity,
        //     url: 'http://localhost/dashboard/users/user/offline',
        //     headers: {
        //         'Content-Type': 'application/json',
        //     },
        //     data: data
        // };

        // axios.request(config)
        //     .then((response) => {
        //         // console.log(response.data.data.userName + " disconnect");
        //     })
        //     .catch((error) => {
        //         console.log(error);
        //     });

    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Server is running sucessfully http://127.0.0.1:${PORT}/`);
});
