const http=require("http");
const express=require ("express");

const app=express();

const server=http.createServer(app);
const port=process.env.PORT || 3000;

app.get('/', (req, res) => {
    res.sendFile(___dirname + '/chat.html');
})


server.listen(port,()=>{
    console.log("Server started at"+port);
})

