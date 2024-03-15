<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="../../CSS/DOC_ROUTING.css">
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

function convertHTMLtoPDF() {
    const { jsPDF } = window.jspdf;

    // Create a new jsPDF object with A4 dimensions (210mm x 297mm)
    const doc = new jsPDF('p', 'pt', 'a4');

    // Select the HTML element containing the content you want to convert
    const pdfjs = document.querySelector('#divID');

    // Convert the HTML content to PDF
    doc.html(pdfjs, {
        callback: function (doc) {
            // Save the PDF with the specified filename
            doc.save("newpdf.pdf");
        },
        margin: 10, // Optional: Set page margin
        onePage: true, // Generate a single-page PDF
        // scale: 0.8 // Adjust the scale (0.8 reduces the content size)
    });
}

</script>

    <div class="container">
                     
        <input  type="button" value="Convert to PDF" onclick="convertHTMLtoPDF()">

        <div class="pdf_cont">       
            <div id="divID">
                <div class="">
                    <h1>Routing Slip / Action Slip</h1> 

                    <div class="doc_details">
                        <input type="text" class="routingnum" name="routingnum" id="">

                        <div class="flex_cont">
                            <label for="date_received">Date|Time Received: </label>
                            <input type="text" name="date_received" id="">
                        </div>

                        <div class="flex_cont">
                            <label for="received_by">Received By: </label>
                            <input type="text" name="received_by" id="">
                        </div>
                        
                        <div class="flex_cont">
                            <label for="doc_type">Document Type: </label>
                            <input type="text" name="doc_type" id="">
                        </div>

                        <div class="flex_cont">
                            <label for="office">Office/Agency: </label>
                            <input type="text" name="office" id="">
                        </div>

                        <div class="flex_cont">
                            <label for="letter_date">Letter Date: </label>
                            <input type="text" name="letter_date" id="">
                        </div>

                        <div class="flex_cont">
                            <label for="subject">Subject: </label>
                            <input type="text" name="subject" id="">
                        </div>
                    </div>

                    <div class="doc_data">
                        <div class="banner"><span>DOC DATA</span></div>

                        <div class="flex_box">
                            <label for="initial">Initial: </label>
                            <input type="text" name="initial" id="" value="APL III" readonly>
                            <label class="ini_date" for="ini_date">Date | Time: </label>
                            <input type="text" name="ini_date" id="">
                        </div>

                        <div class="flex_box">
                            <label for="initial">Initial: </label>
                            <input type="text" name="initial" id="" value="EBD" readonly>
                            <label class="ini_date" for="ini_date">Date | Time: </label>
                            <input type="text" name="ini_date" id="">
                        </div>

                        <div class="division_box">
                            <label for="div_all"><input type="checkbox" name="div_all" id="" disabled>ALL</label>
                            <label for="div_ard"><input type="checkbox" name="div_ard" id="" disabled>ARD</label>
                            <label for="div_lnd"><input type="checkbox" name="div_lnd" id="" disabled>L&D</label>
                            <label for="div_piad"><input type="checkbox" name="div_piad" id="" disabled>PIAD</label>
                            <label for="div_admin"><input type="checkbox" name="div_admin" id="" disabled>ADMIN</label>
                            <label for="div_psych"><input type="checkbox" name="div_psych" id="" disabled>PSYCH</label>
                        </div>

                        <h3>For: </h3>
                        <div class="doc_purp">
                            <label for="pur_review"><input type="checkbox" name="pur_review" id="" disabled>Review</label>
                            <label for="pur_comm"><input type="checkbox" name="pur_comm" id="" disabled>Comment/Observation</label>
                            <label for="pur_ini"><input type="checkbox" name="pur_ini" id="" disabled>Initial/Signature</label>
                            <label for="pur_appr"><input type="checkbox" name="pur_appr" id="" disabled>Approval</label>
                            <label for="pur_impl"><input type="checkbox" name="pur_impl" id="" disabled>Implementation</label>
                            <label for="pur_info"><input type="checkbox" name="pur_info" id="" disabled>Info & Guidance</label>
                            <label for="pur_pay"><input type="checkbox" name="pur_pay" id="" disabled>For Payment</label>
                            <label for="pur_stu"><input type="checkbox" name="pur_stu" id="" disabled>Study/Attend</label>
                            <label for="pur_urge"><input type="checkbox" name="pur_urge" id="" disabled>URGENT ACT</label>
                            <label for="pur_prep"><input type="checkbox" name="pur_prep" id="" disabled>Prepare Reply</label>
                            <label for="pur_final"><input type="checkbox" name="pur_final" id="" disabled>Finalize</label>
                            <label for="pur_note"><input type="checkbox" name="pur_note" id="" disabled>Note & Return File</label>
                        </div>

                        <h3>Notes: </h3>
                    </div>

                    <div class="doc_hr">
                        <div class="banner">For HR Divisions</div>

                        <label for="comply">Complied By: </label>
                        <textarea name="comply" id="" cols="30" rows="1"></textarea>

                        <label for="dt_rec">Date|Time Received: </label>
                        <textarea name="dt_rec" id="" cols="30" rows="1"></textarea>

                        <label for="notes">Notes: </label>
                        <textarea name="notes" id="" cols="50" rows="1"></textarea>
                    </div>

                    <div class="doc_dept">
                        <div class="banner">For Mayor's Office & Other Departments</div>

                        <label for="to">To: </label>
                        <textarea name="to" id="" cols="30" rows="1"></textarea>

                        <label for="position">Position: </label>
                        <textarea name="position" id="" cols="30" rows="1"></textarea>

                        <label for="office">Office: </label>
                        <textarea name="office" id="" cols="30" rows="1"></textarea>

                        <label for="dt_rec">Date|Time Received: </label>
                        <textarea name="dt_rec" id="" cols="30" rows="1"></textarea>

                        <label for="rec_by">Received By: </label>
                        <textarea name="rec_by" id="" cols="30" rows="1"></textarea>

                        <h4>For:</h4>
                        <label for="for_rev"><input type="checkbox" name="for_rev" id="">Review</label>
                        <label for="for_comm"><input type="checkbox" name="for_comm" id="">Comment/Observation</label>
                        <label for="for_sign"><input type="checkbox" name="for_sign" id="">Initial/Signature</label>
                        <label for="for_approv"><input type="checkbox" name="for_approv" id="">Approval</label>
                        <label for="for_urge"><input type="checkbox" name="for_urge" id="">URGENT ACTION</label>
                        <label for="for_impl"><input type="checkbox" name="for_impl" id="">Implementation</label>
                        <label for="for_info"><input type="checkbox" name="for_info" id="">Info & Guidance</label>

                        <h3>Remarks: </h3>
                    </div>

                    <div class="doc_froute">
                        <div class="banner">For Further Routing</div>

                        <table>
                            <thead>
                                <tr>
                                    <th>TO/FOR</th>
                                    <th>ADDRESSEE</th>
                                    <th>DATE</th>
                                    <th>INITIAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>some</td>
                                    <td>jaja</td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>Remarks: </h3>
                    </div>

                    <div class="doc_retslip">
                        <div class="banner">Return Slip</div>

                        <label for="dt_rec">Date|Time Received: </label>
                        <textarea name="dt_rec" id="" cols="30" rows="1"></textarea>

                        <label for="received">Received By: </label>
                        <textarea name="received" id="" cols="30" rows="1"></textarea>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    

</body>
    </script>

</body>


<!-- <script src="script.js"></script> -->

<!-- <iframe id="pdfViewer" width="100%" height="500px" frameborder="0"></iframe> -->

<script type="module">
    // import { jsPDF } from "../../RESOURCES/JSPDF/src/jspdf.js";

    // // Default export is a4 paper, portrait, using millimeters for units
    // const doc = new jsPDF();

    // doc.setFont("helvetica", "normal");
    // doc.text("Hello world!", 10, 10);
    // doc.save("a4.pdf");

    
    
    // // Convert PDF content to data URL
    // const pdfDataUri = doc.output('datauristring');

    
    // Convert PDF content to data URL
    // const pdfDataUri = doc.output('datauristring');
    // Open a new window
    // const newWindow = window.open('', '_blank');
    // Set PDF data URI as the content of the new window
    // newWindow.document.write('<iframe src="' + pdfDataUri + '" width="100%" height="100%"></iframe>');
    // document.getElementById('pdfLink').href = pdfDataUri;

</script>



</html>