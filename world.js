window.onload = function() {

    var httpRequest;
    var lookup_Button = document.getElementById("lookup");
    var cityButton = document.getElementById("city");

    lookup_Button.onclick = countryLookUp;
    cityButton.onclick = cityLookUp;

    function countryLookUp() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var userInput = document.getElementById("country").value;
        
        httpRequest.onreadystatechange = getResults;
        httpRequest.open('GET', "world.php?country=" + userInput);
        httpRequest.send();
    }

    function cityLookUp() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var userCountry = document.getElementById("country").value;
        httpRequest.onreadystatechange = getResults;
        httpRequest.open('GET', "world.php?country=" + userCountry + "&context=cities");
        httpRequest.send();
    }

    function getResults() {
        if(httpRequest.readyState === XMLHttpRequest.DONE) {
          if(httpRequest.status === 200) {
            var response = httpRequest.responseText;
            var resultDiv = document.getElementById("result");
            resultDiv.innerHTML = response;
          } else {
            alert("Something went wrong with the request! Request Status = " + httpRequest.status);
          }
        }
      }


}