<?php

/** @var \App\Models\Article[] $articles */

?>
@extends('layouts.main')

@section('content')
    <section class="pb-[120px] pt-[120px]">
        <div class="container">
            <div class="-mx-4 flex flex-wrap justify-center">
                @foreach($articles as $article)
                    <div class="w-full px-4 py-4 md:w-2/3 lg:w-1/2 xl:w-1/3">
                        <div class="group relative overflow-hidden rounded-sm bg-white shadow-one duration-300 hover:shadow-two dark:bg-dark dark:hover:shadow-gray-dark">
                            <a class="relative block aspect-[37/22] w-full" href="{{route('article.show', $article->slug)}}">
                                <span class="absolute right-6 top-6 z-20 inline-flex items-center justify-center rounded-full bg-primary px-4 py-2 text-sm font-semibold capitalize text-white">{{$article->category->name}}</span>
                                <img alt="{{$article->title}}" loading="lazy" decoding="async" data-nimg="fill" class="article-image" sizes="100vw" src="/storage/{{$article->image_preview}}">
                            </a>
                            <div class="p-6 sm:p-8 md:px-6 md:py-8 lg:p-8 xl:px-5 xl:py-8 2xl:p-8">
                                <h3>
                                    <a class="mb-4 block text-base font-bold text-black hover:text-primary dark:text-white dark:hover:text-primary sm:text-base line-clamp-3" href="{{route('article.show', $article->slug)}}">{{$article->title}}</a>
                                </h3>
                                <div class="flex items-center">
                                    <div class="mr-5 flex items-center border-r border-body-color border-opacity-10 pr-5 dark:border-white dark:border-opacity-10 xl:mr-3 xl:pr-3 2xl:mr-5 2xl:pr-5">
                                        <div class="mr-4">
                                            <div class="relative h-10 w-10 overflow-hidden rounded-full">
                                                <img alt="author" loading="lazy" decoding="async" data-nimg="fill" style="position: absolute; height: 100%; width: 100%; inset: 0; color: transparent;" sizes="100vw" src="/_next/image?url=%2Fimages%2Fblog%2Fauthor-01.png&amp;w=3840&amp;q=75">
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <h4 class="mb-1 text-sm font-medium text-dark dark:text-white">By Samuyl Joshi</h4>
                                            <p class="text-xs text-body-color">Graphic Designer</p>
                                        </div>
                                    </div>
                                    <div class="inline-block">
                                        <h4 class="mb-1 text-sm font-medium text-dark dark:text-white">Date</h4>
                                        <p class="text-xs text-body-color">2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $articles->links('pagination.default') }}
        </div>
    </section>
@endsection
