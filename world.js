window.onload = function() {
  let lookupButton = document.getElementById("lookup");
  let countryInput = document.getElementById("country");
  let resultsDiv = document.getElementById("result");

  lookupButton.onclick = function() {
    let country = countryInput.value;

    fetch("world.php?country=" + encodeURIComponent(country))
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        resultsDiv.innerHTML = data;
      });
  };
};