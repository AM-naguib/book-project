@extends('front.layouts.app')
@section("title", "نتائج البحث عن " . request("search"))
@section("description", getSetting()->description)
@section("keywords", getSetting()->keywords)
@section("schema")
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "{{ getSetting()->site_title }}",
      "url": "{{ env('APP_URL') }}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ env('APP_URL') }}?search={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
@endsection
@section('content')
    <!-- cards start -->
    <section class="cards">
        <div class="container">
            <div class="row">
                <div class="col-12 my-4">
                    <h2 class="text-center">{{ request("search") }}</h2>
                </div>
                @forelse ($books as $book)
                    <div class="col-lg-2 col-xl-2 col-md-4 col-6">
                        <div class="card shadow mb-3" style="width: 100%;">
                            <div class="card-img">
                                <a href="{{route("front.single",$book->slug)}}"><img loading="lazy" src="{{env('APP_URL') ."/storage/". $book->image_url}}" class="card-img-top" alt="..."></a>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-text">
                                    <a href="{{route("front.single",$book->slug)}}">
                                        {{ $book->title }}
                                    </a>
                                </h3>
                                <p class="author-label">
                                    <a href="{{route("front.single",$book->slug)}}">{{ $book->author->name }}</a>
                                </p>
                                <p class="section-label">
                                    <a  href="{{route("front.single",$book->slug)}}">{{ $book->section->name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="alert alert-danger">لا يوجد نتائج</div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- cards end -->
    <div class="pagnation col-8 my-4 text-center mx-auto">
        {{ $books->links() }}
    </div>
@endsection
