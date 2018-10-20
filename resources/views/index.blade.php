@extends('layout.app')

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h1 class="card-title">Blog NotÍcias</h1><a href="noticias" class="btn btn-primary">admin</a>
                    <p class="card=text">
                        sempre atualizado 24h por dia.
                    </p>
                    
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                NOTÍCIAS AQUI
                <div class="card border">
    <div class="card-body">
        

       
    </div>
    <div class="card-footer">
        
    </div>
</div>

            </div>
            </div>            
        </div>
    </div>
</div>

        <table class="table table-ordered table-hover" id="tabelanoticias">
            <thead>
            </thead>
            <tbody>
               
            </tbody>
        </table>


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
            "<td><h2><b>" + p.titulo + "</h2></b>" +
            "<br><p>" + p.conteudo +"</p>"+ '<a href="vermais/' + p.id + '" class="btn btn-sm btn-info"> Ver mais </a> ' + "</p></td></tr>";
        return linha;
    }
    
    
    function carregarNoticias() {
        $.getJSON('http://localhost/api_b/public/all-news', function(noticias) { 
            for(i=0;i<noticias.length;i++) {
                linha = montarLinha(noticias[i]);
                $('#tabelaNoticias>tbody').append(linha);
            }
        });        
    }
    
    
    $(function(){
    
        carregarNoticias();
    })
    
</script>
@endsection
     
     
     
