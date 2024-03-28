import { createServer } from "https";
import { Server } from "socket.io";

const httpServer = createServer();

const io = new Server(httpServer, {
    cors: {
        origin: "*"
    }
});

io.on('connection', socket => {
    console.log(`User ${socket.id} connected`);

    socket.on('message', data => {
        console.log(data)
        io.emit('message', `${socket.id.substring(0,5)}: ${data}`);
    })
})

httpServer.listen(3000, () => console.log(`listen on port 3000`));