window.onload = function() {
  let lookupButton = document.getElementById("lookup");
  let countryInput = document.getElementById("country");
  let resultsDiv = document.getElementById("result");
  let lookupCitiesButton = document.getElementById("lookup-cities");

  lookupButton.onclick = function() {
    let country = countryInput.value;

    fetch("world.php?country=" + country)
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        resultsDiv.innerHTML = data;
      });
  };

  lookupCitiesButton.onclick = function() {
    let country = countryInput.value;

    fetch("world.php?lookup=cities&country" + country)
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        resultsDiv.innerHTML = data;
      });
  };
};