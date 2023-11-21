document.getElementById('lookup').addEventListener('click', function() {
    const country = document.getElementById('country').value;
    const url = `world.php?country=${country}`;

    fetchCountryData(url);
});

document.getElementById('lookupCities').addEventListener('click', function() {
    const country = document.getElementById('country').value;
    const url = `world.php?country=${country}&lookup=cities`;

    fetchCityData(url);
});

function fetchCountryData(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}

function fetchCityData(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}
