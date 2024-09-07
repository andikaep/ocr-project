===========================
OCR (Image to Text Converter)
===========================

This project is an **Image to Text Converter** built with **CodeIgniter** and **OCR.Space API**.
It allows users to upload images containing text, and the application will extract the text using the OCR.Space API.

Features
========
- Upload images with text content and extract the text using OCR.
- Supports file formats like JPG, PNG, PDF, and more.
- Integrates with **OCR.Space API** for Optical Character Recognition (OCR).
- Error handling for file uploads and API responses.

Requirements
============
To run this project, you will need:

- **PHP** (version 7.3 or higher recommended)
- **CodeIgniter 3.x**
- **cURL extension** for PHP
- **OCR.Space API Key**

Installation
============
Follow the steps below to get started:

1. **Clone the repository**:

   .. code-block:: bash

       git clone https://github.com/yourusername/ocr-project.git
       cd ocr-project

2. **Set up CodeIgniter**:
   
   Ensure that CodeIgniter is correctly installed. Place the project files in the `application` directory of CodeIgniter.

3. **Update your OCR API Key**:

   Open `application/controllers/Ocr.php` and replace `'YOUR_OCR_SPACE_API_KEY'` with your actual OCR.Space API key:

   .. code-block:: php

       $apiKey = 'YOUR_OCR_SPACE_API_KEY';

4. **Ensure cURL is enabled**:

   Check that the **cURL extension** is enabled in your `php.ini` file. You can verify this by running:

   .. code-block:: bash

       php -m | grep curl

5. **Run the project**:

   You can run the project by serving it with a local development server or placing it on a web server (Apache/Nginx).

6. **Access the project**:

   Visit the URL where the project is hosted (e.g., `http://localhost/ocr-project`).

Usage
=====
1. **Upload an Image**:

   After accessing the project, you'll be presented with a form to upload an image. The image must contain text for the OCR process.

2. **Extract Text**:

   Once the image is uploaded, the application will process the image through the OCR.Space API and display the extracted text on the screen.

Supported File Types
====================
The following file formats are supported for image uploads:
- JPG, PNG, PDF, JPEG, BMP, GIF, TIF, TIFF, WEBP

Troubleshooting
===============
- **cURL Errors**: If you encounter issues with SSL or cURL, you can temporarily disable SSL verification in `Ocr.php` for local development by adding:

  .. code-block:: php

      CURLOPT_SSL_VERIFYPEER => false

- **Invalid File Extensions**: Ensure that the uploaded file has one of the supported extensions. If the file extension is not valid, the API will return an error.

- **Invalid API Key**: If the OCR request fails, ensure that you have provided a valid OCR.Space API key and that you have not exceeded your monthly quota.

License
=======
This project is licensed under the MIT License.
