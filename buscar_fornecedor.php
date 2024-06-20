$(document).ready(function () {
    $('#cnpj').on('keyup', function () {
        var cnpj = $(this).val();

        if (cnpj.trim() === '') {
            $('#fornecedor').val(''); // Limpa o campo se o CNPJ estiver vazio
            return;
        }

        $.ajax({
            url: 'buscar_fornecedor.php', // O arquivo que trata a solicitação AJAX
            type: 'POST',
            data: { cnpj: cnpj }, // Dados enviados na solicitação
            success: function (response) {
                console.log('Resposta do servidor:', response); // Para depuração
                $('#fornecedor').val(response); // Preenche o nome do fornecedor com a resposta do servidor
            },
            error: function () {
                console.log('Erro ao buscar fornecedor'); // Para depuração
                $('#fornecedor').val('Erro ao buscar fornecedor');
            }
        });
    });
});
