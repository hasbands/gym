<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4">Scan QR Code untuk melihat detail</h2>
                        
                        <div class="mb-4">
                            {!! $qrCode !!}
                        </div>

                        <a href="#" class="btn btn-primary" onclick="downloadQR()">
                            <i class="fas fa-download me-2"></i>
                            Download QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function downloadQR() {
            const svg = document.querySelector('svg');
            const svgData = new XMLSerializer().serializeToString(svg);
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
            
            img.onload = function() {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                
                const pngFile = canvas.toDataURL('image/png');
                const downloadLink = document.createElement('a');
                downloadLink.download = 'qr-code.png';
                downloadLink.href = pngFile;
                downloadLink.click();
            }
            
            img.src = 'data:image/svg+xml;base64,' + btoa(svgData);
        }
    </script>
</body>
</html>
