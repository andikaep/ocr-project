<?php

class Ocr extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load URL helper
        $this->load->helper('url');
    }

    public function index() {
        // Load form for uploading image
        $this->load->view('upload_form');
    }
   
    public function process_image() {
        $apiKey = 'K82441872488957';  // Ganti dengan API key yang benar
        $imagePath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name']; // Nama file yang diupload
        
        // Ekstensi file yang diperbolehkan
        $allowedExtensions = ['pdf', 'jpg', 'png', 'jpeg', 'bmp', 'gif', 'tif', 'tiff', 'webp'];
        
        // Dapatkan ekstensi file
        $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        
        // Validasi ekstensi file
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo 'File tidak memiliki ekstensi yang valid. Ekstensi yang diizinkan: .pdf, .jpg, .png, .jpeg, .bmp, .gif, .tif, .tiff, .webp';
            return;
        }
    
        // Pastikan gambar diupload
        if (!$imagePath) {
            echo 'Silakan unggah gambar yang valid.';
            return;
        }
    
        // Cek MIME type dari file
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $imagePath);
        finfo_close($finfo);
    
        // Tampilkan MIME type untuk debug
        echo "MIME Type: $mimeType<br>";
    
        // Set up CURLFile dengan nama file dan tipe MIME
        $cfile = new CURLFile($imagePath, $mimeType, $imageName);
    
        $url = 'https://api.ocr.space/parse/image';
    
        // Set up cURL untuk mengirim request ke OCR.Space API
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'apikey' => $apiKey,
                'file' => $cfile,
                'language' => 'eng',  // Bahasa Inggris (untuk tes sementara)
            ),
            CURLOPT_SSL_VERIFYPEER => false,  // Nonaktifkan verifikasi SSL (untuk testing lokal)
        ));
    
        // Eksekusi request dan dapatkan responsenya
        $response = curl_exec($curl);
        
        // Cek apakah ada error pada cURL
        if (curl_errno($curl)) {
            echo '<h3>cURL Error:</h3>';
            echo curl_error($curl);
            curl_close($curl);
            return;
        }
    
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Cek status HTTP
        curl_close($curl);
    
        // Decode JSON response
        $result = json_decode($response, true);
    
        // Tampilkan response lengkap untuk debugging
        echo '<h3>Full Response from API:</h3>';
        echo '<pre>' . print_r($result, true) . '</pre>';
        
        // Cek apakah response valid dan tidak kosong
        if ($http_code != 200 || empty($result)) {
            echo '<h3>Error:</h3>';
            echo 'Gagal memproses permintaan. Coba lagi atau cek API key Anda.';
            return;
        }
    
        // Cek apakah ada 'ErrorMessage' dalam response
        if (isset($result['ErrorMessage'])) {
            echo '<h3>Error dari API:</h3>';
            echo '<pre>' . print_r($result['ErrorMessage'], true) . '</pre>';
            return;
        }
    
        // Cek apakah ada hasil OCR (ParsedResults dan ParsedText)
        if (isset($result['ParsedResults']) && is_array($result['ParsedResults']) && isset($result['ParsedResults'][0]['ParsedText'])) {
            // Ambil teks yang dihasilkan oleh OCR
            $extractedText = $result['ParsedResults'][0]['ParsedText'];
            echo '<h3>Hasil OCR:</h3>';
            echo '<pre>' . $extractedText . '</pre>';
        } else {
            echo '<h3>Error:</h3>';
            echo 'Tidak ada teks yang dihasilkan atau terjadi kesalahan pada gambar.';
        }
    }
    
    
    
    
    
    
    }
        
