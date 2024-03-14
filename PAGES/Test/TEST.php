<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="TEST.css">
    <link rel="stylesheet" href="../../CSS/Modal.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>

</head>

<body>


    <!-- 

    <script type="module">
        console.log("SADASD");
        import { jsPDF } from '../../node_modules/jspdf/dist/jspdf.es.js';

        var doc = new jsPDF();
        console.log(doc);

        // Add content to the PDF document
        doc.text("Hello, world!", 10, 10);

        // Save the PDF document
        doc.save("../example.pdf");




    </script> -->

</body>


<!-- <script src="script.js"></script> -->

<iframe id="pdfViewer" width="100%" height="500px" frameborder="0"></iframe>

<script type="module">
    import { jsPDF } from "../../RESOURCES/JSPDF/src/jspdf.js";

    // Default export is a4 paper, portrait, using millimeters for units
    const doc = new jsPDF();

    doc.text("Hello world!", 10, 10);
    // doc.save("a4.pdf");






    //

    // Convert PDF content to data URL
    const pdfDataUri = doc.output('datauristring');
    // Open a new window
    // const newWindow = window.open('', '_blank');
    // Set PDF data URI as the content of the new window
    // newWindow.document.write('<iframe src="' + pdfDataUri + '" width="100%" height="100%"></iframe>');
    document.getElementById('pdfLink').href = pdfDataUri;

</script>

</html>