// ausblenden und einblenden der Formulare

function loadAdressForm() {
    document.getElementById("accountForm2").style.display = "none";
    document.getElementById("accountForm").style.display = "block";
}

function loadPasswordForm() {
    document.getElementById("accountForm").style.display = "none";
    document.getElementById("accountForm2").style.display = "block";
}

// Beide ausblenden

function cancelForm() {
    document.getElementById("accountForm").style.display = "none";
    document.getElementById("accountForm2").style.display = "none";
}


// Überschrift laden im Backend

function loadContent(url) {
    var navHeadline = document.getElementById("navheadline");

    $('#content').load(url);

    if(url === 'depositwithdrawal.php') {
        navHeadline.innerHTML = "Ein-/Auszahlung";

    } else if(url === 'transfer.php') {
        navHeadline.innerHTML = "Überweisung";

    } else if(url === 'statements.php') {
        navHeadline.innerHTML = "Kontoauszüge";

    } else if(url === 'account.php') {
        navHeadline.innerHTML = "Persönliche Daten";

    } else if(url === 'userlist.php') {
        navHeadline.innerHTML = "Nutzer Übersicht";

    } else if(url === 'statementslist.php') {
        navHeadline.innerHTML = "Kontoauszüge";

    } else if(url === 'userrequests.php') {
        navHeadline.innerHTML = "Nutzer Anfragen";

    } else if(url === 'userlist_admin.php') {
        navHeadline.innerHTML = "Nutzer Übersicht";

    } else {

        navHeadline.innerHTML = "Konto Übersicht";
    }
}

