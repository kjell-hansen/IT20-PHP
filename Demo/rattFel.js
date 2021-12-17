window.onload=hamtaStandard();

document.getElementById("fel").addEventListener('click', hamtaStandard);

document.getElementById("ratt").onclick = function () {
    fetch('rattFel.php?svar=rätt')
            .then(response => {
                return response.text();
            })
            .then(data => {
                document.getElementById("svar").innerHTML=data;
            });
};

function hamtaStandard() {
    fetch('rattFel.php')
            .then(response => {
                return response.text();
            })
            .then(data => {
                document.getElementById("svar").innerHTML=data;
            });
};
