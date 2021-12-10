// Hämta ett meny-liknande html-fragment
function loadMenu() {
    // Skapa ett HttpRequest-objekt som skickar förfrågan till servern
    var xhttp = new XMLHttpRequest();
    // Pop-up-ruta som förvarnar om att menyn hämtas
    alert("Hämtar menyn när du klickar på OK");
    
    // Svarsfunktion för HttpRequest-objektet
    xhttp.onreadystatechange = function() {
        // Om svaret är komplett och lyckat fyller vi divven med texten i svaret
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div1").innerHTML = this.responseText;
       }
    };
    
    // Definiera förfrågan
    xhttp.open("GET", "meny.html", true);
    // Skicka förfrågan och vänta på svar
    xhttp.send();
}

// Hämta en img-tag med innehåll från servern
function loadImage() {
    // Skapa ett HttpRequest-objekt
    var xhttp = new XMLHttpRequest();
    
    // Svarsfunktion för HttpRequest-objektet
    xhttp.onreadystatechange = function () {
        // Om svaret är komplett fyll divven med svarstexten
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div2").innerHTML = this.responseText;
        }
    };
    // Definiera förfrågan
    xhttp.open("GET", "bild.html", true);
    // Skicka iväg förfrågan och vänta på svar
    xhttp.send();
}

function setTimer() {
    // Sätter igång timern och anropar funktionen getLottoAndTime
    window.setInterval(getLottoAndTime, 60000); // 60000ms = 60s= 1 minut
    getLottoAndTime();
}
function getLottoAndTime() {
    // Skapar ett HttpRequest-objekt
    var xhttp = new XMLHttpRequest();
    // Definierar funktion för att ta emot svaret
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Svaret är komplett och ok - parsa json-svaret till ett objekt
            var obj = JSON.parse(this.responseText);
            // Skriv ut Lotto-fältet till rätt span
            document.getElementById("Lotto").innerHTML = obj.Lotto;
            // Skriv ut server-tiden til rätt span
            document.getElementById("tid").innerHTML = obj.ServerTime;
        }
    };
    // Förbered förfrågan
    xhttp.open("GET", "lotto.php", true);
    // Skicka iväg frågan och vänta på svar
    xhttp.send();
}

// Funktionen hämtar de namn som matchar inmatade tecken och visar dem i en div
function loadNames() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divNames").innerHTML = this.responseText;
        }
    };
    data="namn=" + document.getElementById("nameSearch").value;
    xhttp.open("POST", "names.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}
