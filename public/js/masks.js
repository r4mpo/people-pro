/* Formatando CNPJ */
function mCNPJ(cnpj) {
    cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5")
    return cnpj
}

function fMascCNPJ(objeto, mascara) {
    obj = objeto
    masc = mascara
    setTimeout("fMascCNPJEx()", 1)
}

function fMascCNPJEx() {
    obj.value = masc(obj.value)
}

/* Formatando campos numéricos */
function apenasNumeros(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /^[0-9.]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}