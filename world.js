document.addEventListener('DOMContentLoaded', function() {
    // Listen for clicks on the 'Lookup' button
    document.getElementById('lookup').addEventListener('click', function() {
        // Get the input value (country name) from the user
        var country = document.getElementById('country').value;
        
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        
        // Define the AJAX request
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the 'result' div with the fetched data
                    document.getElementById('result').innerHTML = xhr.responseText;
                } else {
                    // Handle error states here
                    console.error('Error fetching data');
                }
            }
        };

        // Open a GET request to world.php with the country name as a parameter
        xhr.open('GET', 'world.php?country=' + country, true);
        xhr.send(); // Send the request
    });
});
