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

            $('#listarProjeto').append($('<option>', {
                value: data[i].projetoId,
                text: data[i].projetoNome
            }));
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
    });

    $("body").on("click", "#cadastrarProjeto", function(e) {
        e.preventDefault();
        $("#cadProjeto").modal('show');
    });

    $("body").on("click", "#cadastrar", function(e) {
        e.preventDefault();
        let erro = false;
        $(".error").removeClass("error");
        if ($("#nome").val() == "") {
            $("#nome").addClass("error");
            erro = true;
        }
        if ($("#inicio").val() == "") {
            $("#inicio").addClass("error");
            erro = true;
        }
        if ($("#fim").val() == "") {
            $("#fim").addClass("error");
            erro = true;
        }

        if (erro) {
            alert("Prencha os campos obrigatórios (*)");
        } else {
            var dados = {
                projetoNome: $("#nome").val(),
                projetoDataInicio: $("#inicio").val(),
                projetoDataFim: $("#fim").val()
            }

            $.ajax({
                url: "api/projeto/criarProjeto.php",
                type: "POST",
                data: {'dados': dados},
                dataType: "JSON",
                success: function (r) {
                    alert(r.message);
                    $("#cadProjeto").modal('hide');
                    location.reload();
                }
            });
        }
    });

    $("body").on("click", "#cadastrarAtividade", function(e) {
        e.preventDefault();
        $("#cadAtividade").modal('show');
    });

    $("body").on("click", "#cadAtiv", function(e) {
        e.preventDefault();
        let erro = false;
        $(".error").removeClass("error");
        if ($("#listarProjeto").val() == 0) {
            $("#listarProjeto").addClass("error");
            erro = true;
        }
        if ($("#nomeAtividade").val() == "") {
            $("#nomeAtividade").addClass("error");
            erro = true;
        }
        if ($("#inicioAtividade").val() == "") {
            $("#inicioAtividade").addClass("error");
            erro = true;
        }
        if ($("#fimAtividade").val() == "") {
            $("#fimAtividade").addClass("error");
            erro = true;
        }

        if (erro) {
            alert("Prencha os campos obrigatórios (*)");
        } else {
            var dados = {
                projetoId: $("#listarProjeto").val(),
                projetoNome: $("#listarProjeto").val(),
                projetoDataInicio: $("#inicioAtividade").val(),
                projetoDataFim: $("#fimAtividade").val()
            }

            $.ajax({
                url: "api/projeto/criarProjeto.php",
                type: "POST",
                data: {'dados': dados},
                dataType: "JSON",
                success: function (r) {
                    alert(r.message);
                    $("#cadProjeto").modal('hide');
                    location.reload();
                }
            });
        }
    });
});