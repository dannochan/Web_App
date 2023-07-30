
// Die Schlagwörter submitten wenn Eingabe gedrückt wird
document.getElementById("filter-Btn").addEventListener("keyup", function (event) {
  if (event.keyCode === 13) {
    event.defaultPrevented;
    document.getElementById("filter-Btn").click;
  }

})

$('#my-table tbody tr').click(function () {
  if ($(this).hasClass('table-primary')) {
    $(this).removeClass('table-primary');
  } else {
    $(this).addClass('table-primary').siblings().removeClass('table-primary');
  }
})

function validate_info(event) {
  remove_error_msg();
  change_border_color();
  var uniname = document.querySelector("#uniname").value;
  var unilocation = document.querySelector("#unilocation").value;
  var unicountry = document.querySelector("#unicountry").value;
  var unicontact = document.querySelector("#unicontact").value;
  var unigrade = document.querySelector("#unigrade").value;
  var unilink = document.querySelector("#unilink").value;
  var unilogo = document.querySelector("#unilogo").value;
  var unifotos = document.querySelector("#unifotos").value;
  var description = document.querySelector("#kurzBeschreibung").value;
  var check = true;

  if (uniname == "") {
    document.getElementById("uniname").style = "border-color: red";
    check = false;
  } else {
    let pattern = /[0-9]+/;
    if (pattern.test(uniname) || uniname.length < 5) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte für die Universität einen gültigen Namen nur mit Buchstaben eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUN";
      div.appendChild(p);
      document.getElementById("uniname").style = "border-color: red";
      check = false;
    }
  }

  if (unilocation == "") {
    document.getElementById("unilocation").style = "border-color: red";
    check = false;
  } else {
    let pattern = /[0-9]+/;
    if (pattern.test(unilocation) || unilocation.length < 5) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte für die Adresse der Universität nur Buchstaben eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUL";
      div.appendChild(p);
      document.getElementById("unilocation").style = "border-color: red";
      check = false;
    }
  }

  if (unicountry == "") {
    document.getElementById("unicountry").style = "border-color: red";
    check = false;
  } else {
    let pattern = /[0-9]+/;
    if (pattern.test(unicountry) || unicountry.length < 5) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte für das Land der Universität nur Buchstaben eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUC";
      div.appendChild(p);
      document.getElementById("unicountry").style = "border-color: red";
      check = false;
    }
  }
  if (unicontact == "") {
    document.getElementById("unicontact").style = "border-color: red";
    check = false;
  } else {
    let pattern = /[0-9]+/;
    if (pattern.test(unicontact) || unicontact.length < 3) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte für den Ansprechspartner der Universität nur Buchstaben eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUCo";
      div.appendChild(p);
      document.getElementById("unicontact").style = "border-color: red";
      check = false;
    }
  }

  if (unigrade == "") {
    document.getElementById("unigrade").style = "border-color: red";
    check = false;
  } else {
    let pattern = /[a-zA-Z]+/;
    if (pattern.test(unigrade)) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte für die Noten der Universität eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUG";
      div.appendChild(p);
      document.getElementById("unigrade").style = "border-color: red";
      check = false;
    }
  }

  if (description == "") {
    document.getElementById("kurzBeschreibung").style = "border-color: red";
    check = false;
  } else {
    if ((description.length) < 6) {
      var div = document.getElementById("profErstellen");
      var p = document.createElement("div");
      p.innerHTML = "Bitte eine gültige Beschreibung für die Universität eingeben!";
      p.style.cssText = "color:red;";
      p.id = "ErrorUD";
      div.appendChild(p);
      document.getElementById("kurzBeschreibung").style = "border-color: red";
      check = false;
    }
  }
  if (unilink == "") {
    document.getElementById("unilink").style = "border-color: red";
    check = false;
  }
  if (unilogo == "") {
    document.getElementById("unilogo").style = "border-color: red";
    check = false;
  }
  if (unifotos == "") {
    document.getElementById("unifotos").style = "border-color: red";
    check = false;
  }
  if (!check) {
    event.preventDefault();
  }
}

/**
 * Change the color of the text and subject line blick to grey.
 */
function change_border_color() {
  document.getElementById("uniname").style = "border-color: grey";
  document.getElementById("unilocation").style = "border-color: grey";
  document.getElementById("unicountry").style = "border-color: grey";
  document.getElementById("unicontact").style = "border-color: grey";
  document.getElementById("unigrade").style = "border-color: grey";
  document.getElementById("unilink").style = "border-color: grey";
  document.getElementById("unilogo").style = "border-color: grey";
  document.getElementById("unifotos").style = "border-color: grey";
  document.getElementById("kurzBeschreibung").style = "border-color: grey";
}

function remove_error_msg() {
  if (document.getElementById("ErrorUN")) {
    document.getElementById("ErrorUN").remove();
  }
  if (document.getElementById("ErrorUL")) {
    document.getElementById("ErrorUL").remove();
  }
  if (document.getElementById("ErrorUC")) {
    document.getElementById("ErrorUC").remove();
  }
  if (document.getElementById("ErrorUCo")) {
    document.getElementById("ErrorUCo").remove();
  }
  if (document.getElementById("ErrorUG")) {
    document.getElementById("ErrorUG").remove();
  }
  if (document.getElementById("ErrorUL")) {
    document.getElementById("ErrorUL").remove();
  }
  if (document.getElementById("ErrorUD")) {
    document.getElementById("ErrorUD").remove();
  }
}


