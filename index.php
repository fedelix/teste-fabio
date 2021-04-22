<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Projetos</title>
    <link href="inc/css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="py-5 text-center">
            <h3>Projetos cadastrados</h3>
            <button type="button" id="cadastrarProjeto" class="btn btn-primary">Cadastrar projeto</button><br><br>
            <center>
            <table border="1" style="width:100%">
                <thead>
                    <tr>
                        <th>Projeto</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>% completo</th>
                        <th>Atrasado</th>
                        <th>Atividades</th>
                    <tr>
                </thead>
                <tbody id="projetos"></tbody>
            </table>
            <center>  
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="detalhesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atividades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table border="1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Projeto</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Dinalizado</th>
                        <tr>
                    </thead>
                    <tbody id="atividadesDetalhes"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="cadProjeto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cadProj">
                    <div class="form-group">
                        <label for="nome">Nome do projeto*:</label>
                        <input type="text" class="form-control" id="nome" placeholder="Nome do projeto">
                    </div>
                    <div class="form-group">
                        <label for="inicio">Data início*:</label>
                        <input type="date" class="form-control" id="inicio">
                    </div>
                    <div class="form-group">
                        <label for="fim">Data final*:</label>
                        <input type="date" class="form-control" id="fim">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cadastrar" class="btn btn-primary">Cadastrar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <script src="inc/js/jQuery.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/moment.js"></script>
    <script src="inc/js/main.js"></script>
</body>
</html>