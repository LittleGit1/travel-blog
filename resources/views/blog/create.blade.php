@extends('layout')

@section('header')
    <x-dashboard-header>
        <div>
            <ul>
                <li>
                    <a href="/account/dashboard"
                        class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Dashboard</a>
                </li>
            </ul>
        </div>
    </x-dashboard-header>
@endsection

@section('content')
    <form x-data="createPost" action="/blog/posts/create" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->count() > 0)
            <span class="bg-white font-medium rounded-xl block px-4 py-4 mb-4 text-red-600">There was a problem submitting
                your post. Please correct errors displayed below.</span>
        @endif

        <div class="flex gap-x-4">
            {{-- Featured Image --}}
            <div class="bg-white rounded-xl p-4 inline-flex flex-col flex-none">
                <div class="flex gap-x-2 mb-4">
                    <x-svg-icon icon_name="image_thumbnail" />
                    <span>Featured Image</span>
                </div>
                <div>
                    <label class="inline-block relative group cursor-pointer" for="featured_image">
                        <img id="featured_image_display" src="{{ asset('img/placeholder.webp') }}" width="256px"
                            height="256px" alt="" class="w-64 h-64 object-cover">
                        <span
                            class="w-full min-w-full min-h-full h-full absolute top-0 left-0 items-center bg-[rgba(0,0,0,0.6)] opacity-0 justify-center flex transition-[opacity] duration-300 group-hover:opacity-[0.6]"><x-svg-icon
                                icon_name="image_thumbnail" size="size-10" stroke_color="white" /></span>
                    </label>
                    <input id="featured_image" name="featured_image" type="file"
                        class="absolute -z-1 w-[0.1] h-[0.1] opacity-0 overflow-hidden">
                </div>
            </div>

            {{-- Carousel Images --}}
            <div class="bg-white rounded-xl p-4 flex flex-col grow">
                <div class="flex gap-x-2 mb-4">
                    <x-svg-icon icon_name="image_thumbnail" />
                    <span>Carousel Images</span>
                    <div>
                        <label class="inline-block relative group cursor-pointer" for="carousel_images">
                            <x-svg-icon icon_name="plus_circle" />
                        </label>
                        <input multiple type="file" accept=".jpg, .jpeg, .png" name="carousel_images[]"
                            id="carousel_images" class="absolute -z-1 w-[0.1] h-[0.1] opacity-0 overflow-hidden">
                    </div>
                </div>
                <div class="relative h-full">
                    <div id="carousel_container"
                        class="absolute top-0 left-0 h-full w-full gap-x-4 overflow-x-scroll scrollbar-hide hidden"></div>
                </div>
            </div>
        </div>

        {{-- Title, Slug, Body --}}
        <div class="flex flex-col gap-y-4 py-4">
            <div class="flex flex-col">
                <input aria-label="title" type="text" id="title" name="title" value="{{ old('title') ?? '' }}"
                    class="rounded-xl p-4 placeholder:text-slate-400" placeholder="Title">
                @if ($errors->has('title'))
                    <span class="block text-red-600 text-sm px-4 pt-1">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="flex flex-col">
                <input aria-label="slug" type="text" id="slug" name="slug" value="{{ old('slug') ?? '' }}"
                    class="rounded-xl p-4 placeholder:text-slate-400" placeholder="Slug">
                @if ($errors->has('slug'))
                    <span class="block text-red-600 text-sm px-4 pt-1">{{ $errors->first('slug') }}</span>
                @endif
            </div>

            <div class="flex flex-col">
                <textarea aria-label="body" name="body" id="body" placeholder="Content" cols="30" rows="10"
                    class="rounded-xl p-4 resize-none">{{ old('body') ?? '' }}</textarea>
                @if ($errors->has('body'))
                    <span class="block text-red-600 text-sm px-4 pt-1">{{ $errors->first('body') }}</span>
                @endif
            </div>
        </div>
        <div>
            <a class="rounded-md bg-red-500 text-white px-4 py-3 inline-block" href="/account/posts">Cancel</a>
            <button class="border-0 rounded-md bg-green-500 text-white px-4 py-3" type="submit">Save</button>
        </div>
    </form>
@endsection

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('createPost', () => ({
            featuredImageInput: undefined,
            featuredImageDisplay: undefined,
            featuredImageTooLarge: false,
            carouselImagesInput: undefined,
            //carouselErrorMessage: undefined,
            //showCarouselErrorMessage: undefined,
            carouselContainer: undefined,
            carouselImages: undefined,

            init() {
                this.featuredImageInput = document.getElementById('featured_image');
                this.featuredImageDisplay = document.getElementById('featured_image_display');
                this.carouselImagesInput = document.getElementById('carousel_images');
                this.carouselContainer = document.getElementById('carousel_container');

                this.featuredImageInput.addEventListener('change', (event) => {
                    this.handleImages(event);
                });

                this.carouselImagesInput.addEventListener('change', (event) => {
                    this.handleImages(event);
                })
            },

            handleImages(event) {
                switch (event.target.id) {
                    case "featured_image":
                        const file = event.target.files[0];
                        if (file.size > 3000000) {
                            this.featuredImageTooLarge = true
                            return;
                        }
                        this.featuredImageTooLarge = false;
                        this.featuredImageDisplay.src = URL.createObjectURL(event.target.files[0])
                        break;

                    case "carousel_images":
                        //this.showCarouselErrorMessage = false;
                        //this.carouselErrorMessage = "";

                        const files = event.target.files;

                        // restrict the number of files to 5
                        // if (files.length > 5) {
                        //     //this.carouselErrorMessage = "A maximum of five images can be uploaded."
                        //     //this.showCarouselErrorMessage = true;
                        //     return;
                        // }

                        for (let i = 0; i < files.length; i++) {
                            // don't accept images over 3MB in size
                            if (files[i].size > 3000000) continue;

                            this.carouselContainer.appendChild(this.createImageComponent(files[i],
                                files[i].name));
                            this.carouselContainer.classList.add('flex');
                            this.carouselContainer.classList.remove('hidden');
                        }
                        break;
                }
            },

            createFigure() {
                const figure = document.createElement('figure');
                figure.classList.add('w-64', 'h-64', 'relative', 'flex-none', 'group');
                return figure;
            },

            createTrashButton(id) {
                const button = document.createElement('button');

                // Create the SVG namespace
                const svgNS = "http://www.w3.org/2000/svg";

                // Create the SVG element
                const svg = document.createElementNS(svgNS, 'svg');
                svg.setAttribute('width', '24');
                svg.setAttribute('height', '24');
                svg.setAttribute('viewBox', '0 0 24 24');
                svg.setAttribute('fill', 'none');
                svg.setAttribute('stroke', 'white');
                svg.setAttribute('stroke-width', '1.5');
                svg.setAttribute('stroke-linecap', 'round');
                svg.setAttribute('stroke-linejoin', 'round');
                svg.setAttribute('class', 'size-10');

                // Create the path element
                const path = document.createElementNS(svgNS, 'path');
                path.setAttribute('d',
                    'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'
                    );

                // Append the path to the SVG
                svg.appendChild(path);
                button.appendChild(svg);

                button.addEventListener('click', () => {
                    this.deleteImage(id)
                })

                return button;
            },

            createDiv(id) {
                const div = document.createElement('div');
                div.appendChild(this.createTrashButton(id));
                div.classList.add('w-full', 'h-full', 'flex', 'items-center', 'justify-center',
                    'absolute', 'left-0', 'top-0', 'bg-[rgba(0,0,0,0.6)]', 'opacity-0',
                    'transition-[opacity]', 'duration-[0.3s]', 'group-hover:opacity-[0.6]');
                return div;
            },

            createImg(src) {
                const image = document.createElement('img');
                image.src = URL.createObjectURL(src);
                // image.alt = String(id);
                image.width = 256;
                image.height = 256;
                image.classList.add('w-64', 'h-64', 'object-cover');
                return image;
            },

            createImageComponent(src, id) {
                const figure = this.createFigure();
                const div = this.createDiv(id);
                const img = this.createImg(src);

                figure.appendChild(div);
                figure.appendChild(img);

                return figure;
            },

            deleteImage(id) {
                const dt = new DataTransfer()
                Array.from(this.carouselImagesInput.files).forEach((file) => {
                    if (file.name !== id) dt.items.add(file);
                });
                this.carouselImagesInput.files = dt.files;
                this.refreshImageContainer();
            },

            refreshImageContainer() {
                const files = this.carouselImagesInput.files;

                this.carouselContainer.replaceChildren();

                for (let i = 0; i < files.length; i++)
                    this.carouselContainer.appendChild(this.createImageComponent(files[i], files[i]
                        .name));

            }

        }))
    })
</script>
