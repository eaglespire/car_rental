@if(count($testimonials) != 0)
<section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Testimonial</span>
                <h2 class="mb-3">Happy Clients</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    @foreach($testimonials as $testimonial)
                        <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset("storage/testimonials/$testimonial->image") }})">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">{{ $testimonial->body }}</p>
                                <p class="name">{{ $testimonial->name }}</p>
                                <span class="position">{{ $testimonial->job_title }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
