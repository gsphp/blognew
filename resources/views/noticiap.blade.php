@extends('layout.app', ["current" => "produtos" ])

@section('body')

<div class="card border">
    <div class="card-body">
        <h1 class="card-title">Blog Notícias</h1> 
        <table class="table table-ordered table-hover" id="tabelaNoticia">
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       <a href="/blognew/public/">voltar</a>
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
    
    
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td><h1><b>" + p.titulo + "</b></h1>" +
            "<p>" + p.conteudo + "</p>" +
            "<br><h5>categoria:<b>" + p.categoria + "</b> , " +
            "autor:<b>" + p.autor + "</b> , " +
            "palavras chave:<b>" + p.palavraschave + "</b></h5></td></tr>";
        return linha;
    }
    
    
    function carregarNoticia() {
        $.getJSON('http://localhost/api_b/public/all-news/'+<?php echo $id;?>, function(produtos) { 
            //for(i=0;i<produtos.length;i++) {
                linha = montarLinha(produtos);
                $('#tabelaNoticia>tbody').append(linha);
            //}
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
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     