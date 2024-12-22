import axios from 'axios';

// Fungsi untuk menghasilkan data acak
const generateSensorData = () => {
    return {
        hujan: parseFloat((Math.random() * 100).toFixed(2)), // Nilai hujan acak antara 0-100
        dht: {
            temperature: parseFloat((Math.random() * 15 + 20).toFixed(2)), // Suhu antara 20-35 derajat
            humidity: parseFloat((Math.random() * 50 + 30).toFixed(2)),    // Kelembaban antara 30-80%
        },
        api: Math.floor(Math.random() * 500), // Indeks API acak antara 0-500
    };
};

// Fungsi untuk mengirim data ke endpoint server
const sendSensorData = async () => {
    const sensorData = generateSensorData();
    console.log('Generated sensor data:', sensorData);

    try {
        const response = await axios.post('http://localhost:3000/send-sensor-data', sensorData, {
            headers: { 'Content-Type': 'application/json' },
        });
        console.log('Data sent successfully:', response.data);
    } catch (error) {
        console.error('Error sending data:', error.message);
    }
};

// Jalankan interval setiap 10 detik untuk mengirim data
console.log('Starting data generator...');
setInterval(() => {
    sendSensorData();
}, 10000); // Interval 10 detik
