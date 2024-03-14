<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script type="module">
    import { jsPDF } from '../node_modules/jspdf/dist/jspdf.es.min.js';

    // Create a new instance of jsPDF
    var doc = new jsPDF();

    // Add content to the PDF document
    doc.text("Hello, world!", 10, 10);

    // Save the PDF document
    doc.save("example.pdf");
</script>

</body>
</html>