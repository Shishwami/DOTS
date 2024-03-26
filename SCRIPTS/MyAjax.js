/**
 * Represents an AJAX utility class for creating JSON requests.
 */
class MyAjax {
    
    /**
     * Creates a JSON request and sends it to the server.
     * 
     * @param {function} callback The callback function to handle the response.
     * @param {Object} data The data to be sent in the request body.
     */
    static createJSON(callback, data) {
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        
        // Open a POST request to the specified URL
        xhr.open('POST', "../../SCRIPTS/DOTS_API.php", true);

        // Define a callback function to handle state changes
        xhr.onreadystatechange = function () {
            // Check if the request is completed
            if (xhr.readyState == 4) {
                // Check if the request was successful
                if (xhr.status == 200) {
                    // Parse the JSON response
                    const response = JSON.parse(xhr.responseText);
                    // Invoke the callback function with the response data
                    callback(null, response);
                } else {
                    // Invoke the callback function with an error message
                    callback(`Error: ${xhr.status}`);
                }
            }
        };

        // Convert the data object to JSON string
        const jsonData = JSON.stringify(data);
        
        // Send the JSON data in the request body
        xhr.send(jsonData);
    }
    
}

// Export the MyAjax class to be used in other modules
export default MyAjax;
