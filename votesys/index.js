const element = document.getElementById("region");
let comuna = document.getElementById("comuna");

const error = document.getElementById("errorMessage");
error.style.display = "none";

// calling data for comunas and region
element.addEventListener("change", () => {
    const region = element.value;
    comuna.disabled = true;
    const xhr = new XMLHttpRequest(); // creo el request
    xhr.open("GET", "./controllers/comuna/list.php?region_id=" + region.split('-')[0], true); // abro el archivo php y le envio el id de la region a revisar
    xhr.onload = () => { // cuando cargue
        if (xhr.status === 200) { // si el status es de 200
            comuna.innerHTML = "<option selected disabled hidden>Choose a comuna</option>" + xhr.responseText;
            comuna.disabled = false;
            comuna.required = true;
        } else {
            console.error(xhr.statusText);
        }
    };
    xhr.onerror = () => {
        console.error(xhr.statusText);
    };
    xhr.send();
});

const isComplete = (votante) => {
    for (let i in votante) {
        if (votante[i] == "" || votante[i] == null) {
            return false;
        }
    }
    return true;
}

const form = document.getElementById("form");
const list = document.getElementById("list-knew");
form.onsubmit = (e) => {
    e.preventDefault();
}


// jquery validations
$.validator.addMethod('isValidRUT', function(value, element) {
    if (!value || typeof value !== 'string') return false;
  
    let regexp = /^\d{7,8}-[k|K|\d]{1}$/;
    return regexp.test(value);
  }, 'Ingresa un rut valido (ex: 12345678-9)');

$.validator.addMethod('strAndInt', function(value, element) {
    return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
}, 'Este valor requiere de numeros y letras');

$("#form").validate({
    rules: {
        nombre_completo: {
            required: true,
            minlength: 1
        },
        alias: {
            required: true,
            minlength: 5,
            strAndInt: true
        },
        rut: {
            required: true,
            isValidRUT: true
        },
        email: {
            required: true,
            email: true
        },
        region: {
            required: true
        },
        comuna: {
            required: true
        },
        candidato: {
            required: true
        },
    }
})


// jquery uploading
$("#send").click(function() {
    if ($("#form").valid() == false) {
        return;
    }

    let nombre_completo = $("#nombre_completo").val()
    let alias = $("#alias").val()
    let email = $("#email").val()
    let region = $("#region").val()
    let comuna = $("#comuna").val()
    let candidato = $("#candidato").val()

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    let knewFrom = [];
    for (let i = 0; i < 4; i++) {
        const state = list.children[i].children.conocido.checked;
        const name = list.children[i].children.conocido.defaultValue;
        if (state == true) {
            knewFrom.push(name);
        }
    }
    region = data.region_id.split("-")[0];
    const votante = {
        "nombreApellido": data.nombre_completo,
        "alias": data.alias,
        "rut": data.rut,
        "email": data.email,
        "region": region,
        "comuna": data.comuna_id,
        "candidato": data.candidato_id,
        "conocido": knewFrom.toString()
    }

    if (votante.conocido == "") {
        error.style.display = "flex";
        return;
    }
    
    error.style.display = "none";
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './controllers/votante/add.php');
    xhr.onload = function() {
    if (xhr.status === 200) {
        alert(xhr.responseText);
    } else {
        // Request failed, show an error message
        console.error('POST request failed');
    }
    };
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    let params = `nombre_completo=${encodeURIComponent(votante.nombreApellido)}&alias=${encodeURIComponent(votante.alias)}&rut=${encodeURIComponent(votante.rut)}&email=${encodeURIComponent(votante.email)}&region=${encodeURIComponent(votante.region)}&comuna=${encodeURIComponent(votante.comuna)}&candidato=${encodeURIComponent(votante.candidato)}&conocido=${encodeURIComponent(votante.conocido)}`;
    xhr.send(params); // Replace with your data
})