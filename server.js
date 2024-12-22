import express from 'express';
import http from 'http';
import { Server } from 'socket.io';
import cors from 'cors';
import mysql from 'mysql2';

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
    },
});

// Middleware
app.use(cors());
app.use(express.json()); // Untuk parsing JSON payload

// Konfigurasi MySQL
const db = mysql.createConnection({
    host: 'localhost',        
    user: 'root',             // Ganti dengan username MySQL Anda
    password: '',     // Ganti dengan password MySQL Anda
    database: 'vitalforest',  // Ganti dengan nama database Anda
});

// Cek koneksi database
db.connect((err) => {
    if (err) {
        console.error('Database connection failed:', err.stack);
        process.exit(1);
    }
    console.log('Connected to MySQL database');
});

// Endpoint menerima data sensor
app.post('/send-sensor-data', (req, res) => {
    const { hujan, dht, api } = req.body;

    // Validasi data
    if (
        hujan === undefined || 
        dht === undefined || 
        dht.temperature === undefined || 
        dht.humidity === undefined || 
        api === undefined
    ) {
        return res.status(400).json({ message: 'Incomplete data received' });
    }

    const { temperature, humidity } = dht;

    console.log('Received sensor data:', { hujan, temperature, humidity, api });

    // Query untuk menyimpan data ke database
    const query = `
        INSERT INTO sensors (hujan, temperature, humidity, api, created_at, updated_at) 
        VALUES (?, ?, ?, ?, NOW(), NOW())
    `;
    db.query(query, [hujan, temperature, humidity, api], (err, result) => {
        if (err) {
            console.error('Error inserting data:', err);
            return res.status(500).json({ message: 'Failed to save data to database' });
        }

        console.log('Data saved to database:', result);

        // Broadcast data ke semua klien yang terhubung
        io.emit('updateSensorData', { hujan, temperature, humidity, api });

        // Kirim respons ke klien (contohnya Postman atau Raspberry Pi)
        res.status(200).json({ message: 'Data received, saved, and broadcasted' });
    });
});

// Socket.IO connection
io.on('connection', (socket) => {
    console.log('A user connected:', socket.id);

    // Handle disconnection
    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });
});

// Jalankan server
const PORT = 3000;
server.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
