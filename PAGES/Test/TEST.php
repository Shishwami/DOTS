<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="TEST.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>

<body>

<script type="text/javascript">
    // function convertHTMLtoPDF() {
    //     const { jsPDF } = window.jspdf;
 
    //     let doc = new jsPDF('p', 'in', [8, 11]);
    //     let pdfjs = document.querySelector('#divID');
 
    //     doc.html(pdfjs, {
    //         callback: function(doc) {
    //                 doc.save("newpdf.pdf");
    //         },
    //         x: 12,
    //         y: 12
    //     });                
    // }             
    
    // function convertHTMLtoPDF() {
    // const { jsPDF } = window.jspdf;

    // // Create a new jsPDF object with A4 dimensions (210mm x 297mm)
    // const doc = new jsPDF('p', 'mm', 'a4');

    // // Select the HTML element containing the content you want to convert
    // const pdfjs = document.querySelector('#divID');

    // // Convert the HTML content to PDF
    // doc.html(pdfjs, {
    //     callback: function (doc) {
    //         // Save the PDF with the specified filename
    //         doc.save("newpdf.pdf");
    //     },
    //     margin: 32 // Optional: Set page margin
    //     onePage: true // Generate a single-page PDF
    // });
// }

// function convertHTMLtoPDF() {
//     const { jsPDF } = window.jspdf;

//     // Create a new jsPDF object with A4 dimensions (210mm x 297mm)
//     const doc = new jsPDF('p', 'pt', 'a4');

//     // Select the HTML element containing the content you want to convert
//     const pdfjs = document.querySelector('#divID');

//     // Convert the HTML content to PDF
//     doc.html(pdfjs, {
//         callback: function (doc) {
//             // Save the PDF with the specified filename
//             doc.save("newpdf.pdf");
//         },
//         margin: 5, // Optional: Set page margin
//         onePage: true, // Generate a single-page PDF
//         // scale: 0.8 // Adjust the scale (0.8 reduces the content size)
//     });

//     // const doc = new jsPDF('p', 'pt', 'a4');
//     const res = doc.autoTableHtmlToJson(document.getElementById("divID"));
//     doc.autoTable(res.columns, res.data, { startY: 40 });
//     // doc.save("Report.pdf");
// }

function convertTableToPDF() {
    const { jsPDF } = window.jspdf;

    // Create a new jsPDF object with A4 dimensions (210mm x 297mm)
    const doc = new jsPDF('p', 'pt', 'a4');

    // Select the HTML table element containing the data you want to convert
    const tableElement = document.getElementById("divID");

    // Extract table data using jsPDF's autoTableHtmlToJson method
    const tableData = doc.autoTableHtmlToJson(tableElement);

    // Generate the PDF
    doc.autoTable(tableData.columns, tableData.data, { startY: 40 });
    doc.save("TableData.pdf");
}

</script>

    <div class="container">
                     
        <input  type="button" value="Convert to PDF" onclick="convertHTMLtoPDF()">
        <input  type="button" value="Table to PDF" onclick="convertTableToPDF()">

        <div class="pdf_cont">       
            <div id="divID">
                <div class="doc_route">
                    <div class="banner">For Further Routing</div>

                    <table>
                        <tr>
                            <th class="th" rowspan="2">TO/FOR</th>
                            <th>ADDRESSEE</th>
                            <th class="th" colspan="2">DATE</th>
                            <th>INITIAL</th>
                        </tr>
                        <tr>
                            <td>Name & Position</td>
                            <td>In</td>
                            <td>Out</td>
                            <td class="blank">...</td>
                        </tr>
                        <tr>
                            <td class="blank">...</td>
                            <td class="blank">...</td>
                            <td class="blank">.........</td>
                            <td class="blank">...</td>
                            <td class="blank">...</td>
                        </tr>
                        <tr>
                            <td class="blank">...</td>
                            <td class="blank">...</td>
                            <td class="blank">.........</td>
                            <td class="blank">...</td>
                            <td class="blank">...</td>
                        </tr>
                    </table>

                    <h3>Remarks: </h3>
                </div>
            </div>
        </div> 
    </div>
    

</body>
    </script>

</body>

</html>