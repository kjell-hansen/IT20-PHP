// Hämta ett meny-liknande html-fragment
function loadMenu() {
// Pop-up-ruta som förvarnar om att menyn hämtas
    alert("Hämtar menyn när du klickar på OK");
    fetch('meny.html')  // Hämta menyn via fetch-API:et
            .then(response => {
                // När vi fått svar kontrollera att statuskoden är 200
                if (response.status === 200) {
                    // Returnera text
                    return response.text();
                } else {
                    // Något gick fel!
                    throw Error("Hämtningen gick obra");
                }
            }).
            then(data => {
                // Fyll rätt HTML-tagg
                document.getElementById('menu').innerHTML = data;
            })
            .catch(exception => {
                // Visa en alert med felmeddelandet
                alert(exception);
            });
}

// Hämta en img-tag med innehåll från servern
function loadImage() {
    fetch("bild.html")  // Hämtar en img-tagg med en bild
            .then(svar => {
                // Istället för statuskod tittar vi på statustext
                if (svar.statusText === 'OK') {
                    return svar.text();
                } else {
                    // Något gick fel!
                    throw Error("Hämtningen gick obra");
                }
            })
            .then(bild => {
                // Fyll rätt html-tagg
                document.getElementById("bild").innerHTML = bild;
            })
            .catch(exception => {
                // Visa en alert med felmeddelandet
                alert(exception);
            });
}

function setTimer() {
// Sätter igång timern och anropar funktionen getLottoAndTime
    window.setInterval(getLottoAndTime, 10000); // 60000ms = 60s= 1 minut
    getLottoAndTime();
}
function getLottoAndTime() {
    fetch("lotto.php")
            .then(serverAnswer => {
                if (serverAnswer.status === 200) {
                    // Vi fick ett ok till svar!
                    return serverAnswer.json();
                } else {
                    // Något gick fel!
                    throw Error("Hämtningen gick obra");
                }
            })
            .then(jsonData => {
                // Skriv ut Lotto-fältet till rätt span
                document.getElementById("Lotto").innerHTML = jsonData.Lotto;
                // Skriv ut server-tiden til rätt span
                document.getElementById("tid").innerHTML = jsonData.ServerTime;
            })
            .catch(exception => {
                // Visa en alert med felmeddelandet
                alert(exception);
            });
}

// Funktionen hämtar de namn som matchar inmatade tecken och visar dem i en div
function loadNames() {
    fd = new FormData();
    fd.append('namn', document.getElementById("nameSearch").value);
    fetch("names.php", {
        body: fd,
        method: 'POST'
    })
            .then(svar => {
                if (svar.statusText === 'OK') {
                    return svar.json();
                } else {
                    // Något gick fel!
                    throw Error("Hämtningen gick obra");
                }
            })
            .then(object => {
                // Fyll rätt html-tagg
                let namesList = document.getElementById("names");
                namesList.innerHTML = '';
                for (var item of object) {
                    namesList.append(new Option(item));
                }
            })
            .catch(exception => {
                // Visa en alert med felmeddelandet
                alert(exception);
            });
}
