function ViaCep(input) {
    if (input.value.length == 8) {
        fetch(`https://viacep.com.br/ws/${input.value}/json/`)
            .then((response) => response.json())
            .then((response) => {
                if (!response.erro) {
                    document.getElementById('logradouro').value = response.logradouro
                    document.getElementById('bairro').value = response.bairro
                    document.getElementById('cidade').value = response.localidade
                }
            })
            .catch(error => console.error(error));
    }
}

function CnpjWs(input) {
    fetch(`https://publica.cnpj.ws/cnpj/${input.value.replace(/\D/g, "")}/`)
        .then((response) => response.json())
        .then((response) => {
            document.getElementById('razao_social').value = response.razao_social ? response.razao_social : '';
            document.getElementById('capital_social').value = response.capital_social ? response.capital_social.replace(/\D/g, "") : '';
            document.getElementById('nome_fantasia').value = response.estabelecimento.nome_fantasia ? response.estabelecimento.nome_fantasia : '';
            document.getElementById('data_inicio_atividade').value = response.estabelecimento.data_inicio_atividade ? response.estabelecimento.data_inicio_atividade : '';
            document.getElementById('logradouro').value = response.estabelecimento.logradouro ? response.estabelecimento.logradouro : ''
            document.getElementById('numero').value = response.estabelecimento.numero ? response.estabelecimento.numero : ''
            document.getElementById('complemento').value = response.estabelecimento.complemento ? response.estabelecimento.complemento : ''
            document.getElementById('bairro').value = response.estabelecimento.bairro ? response.estabelecimento.bairro : ''
            document.getElementById('cep').value = response.estabelecimento.cep ? response.estabelecimento.cep : ''
            document.getElementById('ddd1').value = response.estabelecimento.ddd1 ? response.estabelecimento.ddd1.replace(/\D/g, "") : ''
            document.getElementById('ddd2').value = response.estabelecimento.ddd2 ? response.estabelecimento.ddd2.replace(/\D/g, "") : ''
            document.getElementById('telefone1').value = response.estabelecimento.telefone1 ? response.estabelecimento.telefone1.replace(/\D/g, "") : ''
            document.getElementById('telefone2').value = response.estabelecimento.telefone2 ? response.estabelecimento.telefone2.replace(/\D/g, "") : ''
            document.getElementById('cidade').value = response.estabelecimento.cidade ? response.estabelecimento.cidade.nome : ''

            if (response.estabelecimento.situacao_cadastral) {
                if (response.estabelecimento.situacao_cadastral === 'Ativa') {
                    document.getElementById('situacao_cadastral1').checked = true;
                    document.getElementById('situacao_cadastral2').checked = false;
                } else {
                    document.getElementById('situacao_cadastral2').checked = true;
                    document.getElementById('situacao_cadastral1').checked = false;
                }
            }
        })
        .catch(error => console.error(error));
}

// Ao selecionar uma opção específica em um select,
// um campo desejado vai ser desabilitado.
function desabilitarInputComCampoDeSelecao(select, option, input)
{
    if(select.value == option){
        input.disabled = true;
    } else {
        input.disabled = false;
    }
}