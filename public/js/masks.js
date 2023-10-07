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

function formatarMoeda(input) {
    valor = input.value;
    valor = valor.replace(/\D/g, ""); // permite digitar apenas numero
    valor = valor.replace(/(\d{1})(\d{14})$/, "$1.$2"); // coloca ponto antes dos ultimos digitos
    valor = valor.replace(/(\d{1})(\d{11})$/, "$1.$2"); // coloca ponto antes dos ultimos 11 digitos
    valor = valor.replace(/(\d{1})(\d{8})$/, "$1.$2"); // coloca ponto antes dos ultimos 8 digitos
    valor = valor.replace(/(\d{1})(\d{5})$/, "$1.$2"); // coloca ponto antes dos ultimos 5 digitos
    valor = valor.replace(/(\d{1})(\d{1,2})$/, "$1,$2"); // coloca virgula antes dos ultimos 2 digitos
    input.value = valor;
}

function formatarTelefoneSemDDD(input) {
    const numero = input.value.replace(/\D/g, '');
    let formato;
    if (numero.length <= 8) {
        formato = 'XXXX-XXXX';
    } else {
        formato = 'XXXXX-XXXX';
    }
    let telefoneFormatado = '';
    let j = 0;
    for (let i = 0; i < formato.length; i++) {
        if (formato[i] === 'X') {
            if (j < numero.length) {
                telefoneFormatado += numero[j];
                j++;
            }
        } else {
            telefoneFormatado += formato[i];
        }
    }
    input.value = telefoneFormatado;
}

function formatarTelefoneComDDD(input) {
    const numero = input.value.replace(/\D/g, '');
    let formato;
    if (numero.length <= 8) {
        formato = '(XX) XXXX-XXXX';
    } else {
        formato = '(XX) XXXXX-XXXX';
    }
    let telefoneFormatado = '';
    let j = 0;
    for (let i = 0; i < formato.length; i++) {
        if (formato[i] === 'X') {
            if (j < numero.length) {
                telefoneFormatado += numero[j];
                j++;
            }
        } else {
            telefoneFormatado += formato[i];
        }
    }
    input.value = telefoneFormatado;
}


function formatarCpfInput(input) {
    let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Formata o CPF (###.###.###-##)
    input.value = value;
}


function formatarRgInput(input) {
    let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3-$4'); // Formata o RG (##.###.###-#)
    input.value = value;
}

