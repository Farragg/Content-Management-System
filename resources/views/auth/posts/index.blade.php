@extends('layouts.auth')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel= "stylesheet">
    <link href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css" type="text/css" rel= "stylesheet">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Posts </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(count($posts) > 0)
                                <h4 class="card-title">Posts</h4>
                                <table id="posts-table" class="table table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th> Image </th>
                                        <th> Title </th>
                                        <th> Description </th>
                                        <th> Category </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td class="py-1">
                                                    <img src="{{ $post->gallery->image}}" alt="image" />
                                                </td>
                                                <td> {{ $post->title }} </td>
                                                <td>
                                                    <span>
                                                        {!! Str::limit( strip_tags($post->description), 20, '...') !!}
                                                    </span>
                                                </td>
                                                <td> {{ $post->category->name }} </td>
                                                <td> {{ $post->is_published == 1 ? 'Published' : 'Draft' }} </td>
                                                <td>
                                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
{{--                                                    <a href="{{ route('posts.destroy', $post->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>--}}
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h3 class="text-center text-danger">No Posts Found</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js" type="text/javascript" charset="utf8"></script>
    <script>
        $(document).ready(function (){
            $('#posts-table').DataTable();
    </script>
@endsection
