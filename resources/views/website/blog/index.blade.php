@extends('layouts.website')

@section('content')
    <section class="page-title bg-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1>Blogs</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="post">
                                <div class="post-media post-thumb">
                                    <a href="blog-single.html">
                                        <img src="{{ $post->gallery->image }}" style="width: 70%" alt="">
                                    </a>
                                </div>
                                <h3 class="post-title"><a href="blog-single.html">{{ $post->title }}</a></h3>
                                <div class="post-meta">
                                    <ul>
                                        <li>
                                            <i class="ion-calendar"></i>  {{ date('d M Y',strtotime($post->created_at)) }}
                                        </li>
                                        <li>
                                            <a href=""><i class="ion-pricetags"></i> {{ $post->category->name }}</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="post-content">
                                    <p> {!! Str::limit(strip_tags($post->description), 200) !!}</p>
                                </div>
                                <div class="post-content">
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-main">Continue Reading</a>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <h2 class="text-center text-danger mt-5"> No Posts added yet</h2>
                    @endif
                    {{ $posts->links() }}
                </div>
                <div class="col-md-4">
                    <aside class="sidebar">
                        <!-- Widget Latest Posts -->
                        <div class="widget widget-latest-post">
                            <h4 class="widget-title">Latest Posts</h4>
                                @if(count($latestPosts) > 0)
                                    @foreach($latestPosts as $latestPost)
                                        <div class="media">
                                            <a class="pull-left" href="{{ route('posts.show', $latestPost->id) }}">
                                                <img class="media-object" src="{{ $latestPost->Gallery->image }}" style="width:50px" alt="Image">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="{{ route('posts.show', $latestPost->id) }}">{{ $latestPost->title }}</a></h4>
                                                <p>{!! Str::limit($latestPost->description, 20) !!}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h6 class="text-center text-danger">No Posts added yet</h6>
                                @endif
                        </div>
                        <!-- End Latest Posts -->

                        <!-- Widget Category -->
                        <div class="widget widget-category">
                            <h4 class="widget-title">Categories</h4>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <ul class="widget-category-list">
                                        <li><a href="#">{{ $category->name }}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            @else
                                <h6 class="text-center text-danger">No Categories added yet</h6>
                            @endif
                        </div> <!-- End category  -->

                        <!-- Widget tag -->
{{--                        <div class="widget widget-tag">--}}
{{--                            <h4 class="widget-title">Tag Cloud</h4>--}}
{{--                            <ul class="widget-tag-list">--}}
{{--                                <li><a href="#">Animals</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#">Landscape</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#">Portrait</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#">Wild Life</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#">Video</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div> <!-- End tag  -->--}}

                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
