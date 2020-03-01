@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary p-1">
                    <div class="card-title text-center text-white"><h4>Dashboard</h4></div>
                </div>
                <div class="card-body text-center">
                    <a class="btn btn-primary text-white">
                        Categorias <span class="badge badge-light"> {{\App\Model\PostCategories::count()}} </span>
                    </a>
                    <a class="btn btn-primary text-white">
                        Posts Publicados
                        <span class="badge badge-light">
                            {{\App\Model\Post::whereNotNull('publication_date')->count()}}
                        </span>
                    </a>
                    <a class="btn btn-primary text-white">
                        Posts Não Publicados
                        <span class="badge badge-light">
                            {{\App\Model\Post::whereNull('publication_date')->count()}}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
