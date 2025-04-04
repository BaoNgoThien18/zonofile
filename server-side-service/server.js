const express = require('express');
const AWS = require('aws-sdk');
const mammoth = require('mammoth');
const xlsx = require('xlsx');
require('dotenv').config();
const app = express();
const port = 3000;
const cors = require('cors');

// Cấu hình AWS SDK
AWS.config.update({
    accessKeyId: process.env.AWS_ACCESS_KEY_ID,
    secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY,
    region: 'us-east-1'
});

const s3 = new AWS.S3();
app.use(cors({ origin: 'http://127.0.0.1:8000' }));

// Route gốc
app.get('/', (req, res) => {
    res.send('Welcome to the File Viewer Application');
});

// Endpoint để tải file từ S3 và chuyển đổi nội dung
app.get('/file/*', (req, res) => {
    const fullPath = req.params[0]; // Lấy toàn bộ chuỗi đường dẫn
    const params = {
        Bucket: 'ngobao',
        Key: fullPath
    };

    s3.getObject(params, (err, data) => {
        if (err) {
            console.error('Error getting object from S3:', err);
            return res.status(500).send('Error retrieving file from S3: ' + err.message);
        }

        const filename = fullPath.toLowerCase();
        if (filename.endsWith('.doc') || filename.endsWith('.docx')) {
            // Chuyển đổi file Word sang HTML
            mammoth.convertToHtml({ buffer: data.Body })
                .then(result => {
                    res.send(result.value);
                })
                .catch(error => {
                    console.error('Error converting file to HTML:', error);
                    res.status(500).send('Error converting file to HTML: ' + error.message);
                });
        } else if (filename.endsWith('.xls') || filename.endsWith('.xlsx')) {
            // Chuyển đổi file Excel sang HTML
            const workbook = xlsx.read(data.Body, { type: 'buffer' });
            let htmlContent = '';
            workbook.SheetNames.forEach(sheetName => {
                const worksheet = workbook.Sheets[sheetName];
                htmlContent += xlsx.utils.sheet_to_html(worksheet);
            });
            res.send(htmlContent);
        } else if (filename.endsWith('.mp4') || filename.endsWith('.webm') || filename.endsWith('.ogg')) {
            // Trả về video file
            res.writeHead(200, {
                'Content-Type': 'video/mp4',
                'Content-Length': data.ContentLength
            });
            res.end(data.Body);
        } else if (filename.endsWith('.jpg') || filename.endsWith('.jpeg') || filename.endsWith('.png') || filename.endsWith('.gif') || filename.endsWith('.webp')) {
            res.writeHead(200, {
                'Content-Type': 'image/' + filename.split('.').pop(), // Lấy phần mở rộng file làm loại MIME
                'Content-Length': data.ContentLength
            });
            res.end(data.Body);
        } else {
            res.status(400).send('Unsupported file type');
        }
    });
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});