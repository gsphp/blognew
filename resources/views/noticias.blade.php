@extends('layout.app')

@section('body')

<div class="card border">
    <div class="card-body">
        <h1 class="card-title">Blog Noticias Admin        <button class="btn btn-sm btn-primary" role="button" onClick="novaNoticia()">Nova Noticia</a></h1>
        

        <table class="table table-ordered table-hover" id="tabelaNoticia">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>CONTEÚDO</th>
                    <th>CATEGORIA</th>
                    <th>AUTOR</th>
                    <th>PALAVRAS CHAVE</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novaNoticia()">Nova Noticia</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgNoticia">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content ">
            <form  id="formNoticia">
                <div class="modal-header">
                    <h5 class="modal-title">Nova noticia</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label  class="control-label">Titulo</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tituloNoticia" placeholder="Insira o titulo da noticia">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="control-label">Conteúdo</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="conteudoNoticia" placeholder="Conteúdo aqui">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label  class="control-label">Categoria</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="categoriaNoticia" placeholder="informe a categoria">
                        </div>
                    </div>                    

                                        <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Autor</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="autorNoticia" placeholder="Autor da notícia">
                        </div>
                    </div>                    

                                        <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Palavras Chave</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="palavraschaveNoticia" placeholder="palavras separadas por virgúla">
                        </div>
                    </div>                    


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novaNoticia() {
        $('#id').val('');
        $('#tituloNoticia').val('');
        $('#conteudoNoticia').val('');
        $('#categoriaNoticia').val('');
        $('#autorNoticia').val('');
        $('#palavraschaveNoticia').val('');
        $('#dlgNoticia').modal('show');
    }
    
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.titulo + "</td>" +
            "<td>" + p.conteudo + "</td>" +
            "<td>" + p.categoria + "</td>" +
            "<td>" + p.autor + "</td>" +
            "<td>" + p.palavraschave + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('http://localhost/api_b/public/all-news/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#tituloNoticia').val(data.titulo);
            $('#conteudoNoticia').val(data.conteudo);
            $('#categoriaNoticia').val(data.categoria);
            $('#autorNoticia').val(data.autor);
            $('#palavraschaveNoticia').val(data.palavraschave);
            $('#dlgNoticia').modal('show');            
        });        
    }
    
    function remover(id) {
        if (!confirm('Deseja realmente excluír a notícia?')) {
            return;
        }

        $.ajax({
            type: "DELETE",
            url: "http://localhost/api_b/public/all-news/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaNoticia>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarNoticia() {
        $.getJSON('http://localhost/api_b/public/all-news', function(produtos) { 
            for(i=0;i<produtos.length;i++) {
                linha = montarLinha(produtos[i]);
                $('#tabelaNoticia>tbody').append(linha);
            }
        });        
    }
    
    function criarNoticia() {
        prod = { 
            id : $("#id").val(), 
            titulo: $("#tituloNoticia").val(), 
            conteudo: $("#conteudoNoticia").val(), 
            categoria: $("#categoriaNoticia").val(), 
            autor: $("#categoriaNoticia").val(),
            palavraschave: $("#palavraschaveNoticia").val() 
        };
        $.post("http://localhost/api_b/public/all-news", prod, function(data) {
            produto = data;
            linha = montarLinha(produto);
            $('#tabelaNoticia>tbody').append(linha);      
            alert('Notícia salva com sucesso!');      
        });
    }
    
    function salvarNoticia() {
        prod = { 
            id : $("#id").val(), 
            titulo: $("#tituloNoticia").val(), 
            conteudo: $("#conteudoNoticia").val(), 
            categoria: $("#categoriaNoticia").val(), 
            autor: $("#autorNoticia").val(),
            palavraschave: $("#palavraschaveNoticia").val() 
        };
        $.ajax({
            type: "PUT",
            url: "http://localhost/api_b/public/all-news",
            context: this,
            data: prod,
            success: function(data) {
                prod = data;
                
                linhas = $("#tabelaNoticia>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.titulo;
                    e[0].cells[2].textContent = prod.conteudo;
                    e[0].cells[3].textContent = prod.categoria;
                    e[0].cells[4].textContent = prod.autor;
                    e[0].cells[5].textContent = prod.palavraschave;
                }

                alert('Alteração realizada com sucesso!');
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formNoticia").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarNoticia();
        else
            criarNoticia();
            
        $("#dlgNoticia").modal('hide');
    });
    
    $(function(){
        
        carregarNoticia();
    })
    
</script>
@endsection
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     