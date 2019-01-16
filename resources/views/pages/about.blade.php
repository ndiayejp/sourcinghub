@extends('layouts.app')


@section('title')
    {{ __('Qui sommes nous') }} | {{config('app.name') }}
@stop

@section('content')
     <div class="container">
         <br>
          <h2> {{ __('Qui sommes-nous?') }} </h2><br>
          <p>{{ __("Sourcing Hub est une place de marché en ligne, spécialisée dans la mise en relation entre acheteurs et fournisseurs dans le monde de l’industrie. La façon la plus simple, efficace et rapide pour trouver des nouveaux fournisseurs ou de nouveaux clients.  L’inscription est gratuite et sans aucune obligation dans le temps.
                ") }}</p>
         <h2> {{ __('Fournisseur') }} </h2><br>
         <p>{{ __("La démarche commerciale devient un art quand celle-ci est mise à l’épreuve ! 
            Il est parfois difficile de s’immiscer au sein d’une petite, moyenne ou grande entreprise, 
            afin d’y développer une démarche commerciale. De trouver le bon interlocuteur, qualifier ses besoins, 
            entreprendre des négociations, signer des contrats et travailler sur du long terme. Notre savoir faire 
            vous permet d’approcher les acteurs majeurs de l’industrie. Ces décideurs qui cherchent des
            fournisseurs sans savoir où les trouver. Vous n’êtes pas toujours disposé à faire du développement 
            quand vous êtes déjà lié avec l’atelier, le personnel ou simplement toute la gestion de l’entreprise.
            C’est la raison pour laquelle 
            Canal Source est la place de marché adaptée à vos besoins en terme de chasse de nouveaux clients !") }}</p>
         <h2> {{ __('Acheteur') }} </h2><br>
         <p>{{ __("Le moteur de recherche industriel dédié aux donneurs d’ordres. Canal Source vous souhaite la bienvenue au sein de sa communauté d’acheteurs. L’outil « achat », indispensable pour trouver des nouveaux sous traitants. L’entreprise se voit des budgets restreints et en même temps l’ambition de se développer sur de nouveaux marchés. L’externalisation du processus d’approvisionnement offre cette solution tout en permettant de réduire les frais d’exploitation.") }}</p>
               
   </div>
@stop