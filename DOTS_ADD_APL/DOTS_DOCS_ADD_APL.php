<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DOTS_DOCS_ADD_APL.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <title>DOTS</title>
</head>

<body>
    <?php include '../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="container" id="main"> <!-- Form Container -->

        <h1>CHRMO</h1>

        <form class="form" action="submit" id="DOCS_ADD_1"> 

            <div class="head"> <!-- Header Input Group -->
                <div class="date_input">
                    <label for="RECEIVED_BY">Received By:</label>
                    <input type="text" name="RECEIVED_BY" id="RECEIVED_BY">
                </div>

                <div class="date_input">
                    <label for="RECEIVED_DATE">Date Received:</label>
                    <input type="date" name="RECEIVED_DATE" id="RECEIVED_DATE">
                </div>
            </div>

            <div class="row"> <!-- Division Input Group -->

                <div class="column one">

                    

                    <table class="table_one">
                        <tr>
                            <th><h2>Recepient</h2></th>
                            <th><h2>Purpose</h2></th>
                        </tr>
                        <tr class="options">
                            <td class="">
                                <form action="" class="select">
                                    <div class="form_group">
                                        <select name="recepient" id="recepient" data-dropdown>
                                            <option value="">From DB</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td class="">
                                <form action="" class="select">
                                    <div class="form_group">
                                        <select name="recepient" id="recepient" data-dropdown>
                                            <option value="">From DB</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="column two"> <!-- Purpose Input Group -->

                    <table>
                        <tr>
                            <th><h2>Purpose</h2></th>
                        </tr>
                        <tr>
                            <td><?php //purpose row from db?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="submit"><input type="submit" value="SUBMIT"></div>

        </form>
    </div>
    <br>
    
</body>

<script>
    //Side Panel Function
    document.getElementById("main").addEventListener("click", closeSidePanel);

    //Dropdown Function
    function getdatabase(){
        hihi}

    const recepient = document.getElementById("recepient");
        const option = document.createElement("option");

        option.value = "variable";
        option.innerText = "dbresult";
        recepient.append(option);

    
</script>

</html>