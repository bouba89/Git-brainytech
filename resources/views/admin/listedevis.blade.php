@extends('layouts.mainlayout')

@section('title', "Administration du site")

@section('contenu')
{{--  header  --}}
<header class="container">
    <div class="row">
        <div class="col-12">                        
            <h1>
                Administration du site
            </h1>
        </div>
    </div>
</header>
{{--  contenu  --}}
<section class="container pb-4">
    <main class="row pt-3">
        <div class="col-12">
            {{-- message de validation --}}
            @if(session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
            @endif      
            <h2>
                Administration des devis
            </h2>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-3">
                    <strong>
                        Date
                    </strong>
                </div>
                <div class="col-md-2">
                    <strong>
                        Montant
                    </strong>
                </div>
                <div class="col-md-1">
                    <strong>
                       Total/Acompte
                    </strong>
                </div>              
                <div class="col-md-3">
                    <strong>
                        Client
                    </strong>
                </div>
                <div class="col-md-1 text-left">
                    <strong>
                       quantite
                    </strong>
                </div>
                <div class="col-md-2 text-center">
                    <strong>
                        Action
                    </strong>
                </div>
                <hr class="col-12">
            </div>              
            @foreach($listemairie as $mairie)
            <div class="row py-1">
                {{-- date du devis --}}
                <div class="col-md-3">
                    {{ $devis->infos_date_devis }}
                </div>
                {{-- montant en euros du devis --}}
                <div class="col-md-2">
                    {{ $devis->infos_montant_devis }}
                </div>
                {{-- 50% ou 100% --}}
                <div class="col-md-1">
                    {{ $devis->infos_reglement }}
                </div>
                {{-- ville --}}
                <div class="col-md-3">
                    {{ $devis->ville }}
                </div>
                {{-- utilisateur --}}
                <div class="col-md-1 text-left">
                    {{ $devis->nbre  }}
                </div>
                {{--  action  --}}
                <div class="col-md-2 text-center">
                    {{--  modification  --}}
                    <a class="btn btn-warning btn-sm" href="{{ URL::to('/')}}/admin/modificationdevis/{{$devis->id_numero_Devis}}">
                        Modifier
                    </a>
                    {{--  suppression  --}}
                    @if($devis->nbre == 0)
                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirmModale" data-id="{{$devis->id_numero_Devis}}">
                            Supprimer
                        </a>
                    @endif
                        
                </div>
            </div>
            <hr class="col-12">
            @endforeach
            {{-- pagination --}}
            <nav aria-label="Page navigation">
                {{ $listemairie->links('vendor.pagination.bootstrap-4') }}
            </nav>
        </div>
    </main>
</section>
{{--  modal  --}}
<div class="modal" tabindex="-1" id="confirmModale" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Confirmer la suppression
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Modal body text goes here.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Fermer
                </button>
                <a type="button" id="confirm" class="btn btn-primary">
                    Valider
                </a>
            </div>
        </div>
    </div>
</div>
  <script type="text/javascript">
    $('#confirmModale').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        $(this).find('.modal-body p').html("Voulez-vous vraiment supprimer ce devis ?");
        $("#confirm").attr("href", "{{URL::to('/')}}/admin/devisupprime/"+id);
    });
</script>  
@endsection