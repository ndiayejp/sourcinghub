
    <div class="inner-box enable-long-words">
            {!! Form::open(['action' => 'PostsController@getAllPosts', 'method' => 'GET','id'=>'filterPosts']) !!}
            <div class="row">
                <div class="col-md-3">
                     <div class="list-filter">
                        <h5 class="list-title">{{ __("Domaine d'activité") }}</h5>
                        <select name="area" id="" class="form-control select">
                            <option value="">{{ __("Choississez") }}</option>
                            @foreach($allareas as $area)
                                @if($area->posts->count()!=0)
                                    <option {{ isset($_GET['area']) && $_GET['area'] == $area->id ? 'selected' : '' }}
                                    value="{{ $area->id }}">{{ $area->name.' ('.$area->posts->count().')' }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                     <div class="list-filter">
                        <h5 class="list-title">{{ __("Secteur d'activité") }}</h5>
                        <select name="cat" id="" class="form-control select">
                            <option value="">{{ __("Choississez") }}</option>
                            @foreach($allcats as $category)
                                @if($category->posts->count()!=0)
                                    <option {{ isset($_GET['cat']) && $_GET['cat'] == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name.' ('.$category->posts->count().')' }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list-filter">
                        <h5 class="list-title">{{ __("Type de marché") }}</h5>
                        <select name="open" class="form-control select">
                            <option value="">{{ __("Choississez") }}  </option>
                            @foreach($allopens as $open)
                                @if($open->posts->count()!=0)
                                    <option {{ isset($_GET['open']) && $_GET['open'] == $open->id ? 'selected' : '' }} value="{{ $open->id }}">{{ $open->name.' ('.$open->posts->count().')' }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list-filter">
                        <h5 class="list-title">{{ __("Lieu d'exécution") }}</h5>
                        <select name="country" class="form-control select">
                            <option value="">{{ __("Choississez") }}</option>
                            @foreach($Allcountries as $country)
                                @if($country->posts->count()!=0)
                                    <option {{ isset($_GET['country']) && $_GET['country'] == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name.' ('.$country->posts->count().')' }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
           <div class="row">
                <div class="col-md-6">
                   <div class="list-filter">
                        <h5 class="list-title">{{ __("Date de publication") }}</h5>
                        <div class="filter-date filter-content">
                            <div class="row">
                                <div class="col-md-6">
                                     <input type="text" name="dateDebut" id="dateDebut" class="Inputdatetime form-control" 
                                    value="<?php echo isset($_GET['dateDebut']) ? $_GET['dateDebut']: ''?>" placeholder="Début">
                                </div>
                                <div class="col-md-6">
                                     <input type="text" name="dateFin" id="dateFin" class="Inputdatetime form-control"
                                    value="<?php echo isset($_GET['dateFin']) ? $_GET['dateFin']: ''?>" placeholder="Fin">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="col-md-6">
                   <div class="list-filter">
                        <h5 class="list-title">{{ __("Date de clôture") }}</h5>
                        <div class="filter-date filter-content">
                            <div class="row">
                                <div class="col-md-6">
                                     <input type="text" name="dateDebutCloture" id="dateDebutCloture" class="Inputdatetime form-control"
                                    value="<?php echo isset($_GET['dateDebutCloture']) ? $_GET['dateDebutCloture']: ''?>" placeholder="Début">
                                </div>
                                <div class="col-md-6">
                                     <input type="text" name="dateFinCloture" id="dateFinCloture" class="Inputdatetime form-control"
                                    value="<?php echo isset($_GET['dateFinCloture']) ? $_GET['dateFinCloture']: ''?>" placeholder="Fin">
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
           
            
            
            
            
            <div class="list-filter">
                    <div class="h-spacer"></div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::button(__('Rechercher'),array('class'=>'btn btn-orange btn-block ', 'type' => 'submit')) !!}
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('posts') }}" class="btn btn-primary btn-block">{{ __('Réinitialiser ') }}</a>
                        </div>
                    </div>
                    </div>
            {!! Form::close() !!}
    </div>
    <div class="h-spacer"></div>
    