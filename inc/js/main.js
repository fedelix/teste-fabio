$( document ).ready(function() {
    $.get("api/projeto/listarProjetos.php", function(data, status) {

        for(let i = 0; data.length > i; i++ ) {
            
            let atrasado = moment(data[i].projetoDataFim).isBefore(moment().format("YYYY-MM-DD")) ? "Sim" : "Não";

            $("#projetos").append( "<tr><td>"+data[i].projetoNome+"</td>"
                +"<td>"+moment(data[i].projetoDataInicio, "YYYY-MM-DD").format("DD/MM/YYYY")+"</td>"
                +"<td>"+moment(data[i].projetoDataFim, "YYYY-MM-DD").format("DD/MM/YYYY")+"</td>"
                +"<td>"+data[i].porcentagem+"%</td>"
                +"<td>"+atrasado+"</td>"
                +"<td><a id='detalhesProjeto' href='javascript:void(0)' data-id='"+data[i].projetoId+"'>Detalhes</a></td></tr>" );
        }
    });

    $("body").on("click", "#detalhesProjeto", function(e) {
        e.preventDefault();
        let idProjeto = $(e.target).data('id');
        $("#atividadesDetalhes").html('');
        $.get("api/atividade/listarAtividades.php?id="+idProjeto, function(dataAtividades, status) {

            for(let c = 0; dataAtividades.length > c; c++ ) {

                $("#atividadesDetalhes").append( "<tr><td>"+dataAtividades[c].atividadeNome+"</td>"
                    +"<td>"+moment(dataAtividades[c].atividadeDataInicio, "YYYY-MM-DD").format("DD/MM/YYYY")+"</td>"
                    +"<td>"+moment(dataAtividades[c].atividadeDataFim, "YYYY-MM-DD").format("DD/MM/YYYY")+"</td>"
                    +"<td>"+(dataAtividades[c].atividadeFinalizada == 1) ? 'Sim': 'Não'+"</td></tr>" );
            }

        });

        $("#detalhesModal").modal('show');
    })
});