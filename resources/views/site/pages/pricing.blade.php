<section id="pricing" class="pricing section-bg">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>Pricing</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                    <div class="box" data-aos="zoom-in" data-aos-delay="300">
                        @if ($plan->recommended)
                            <span class="advanced">Recomendado</span>
                        @endif

                        <h3>{{ $plan->name }}</h3>
                        <h4><sup>R$</sup>{{$plan->price_br}}<span> / {{__($plan->period)}}</span></h4>
                        <ul>
                            @foreach ($plan->details as $detail)
                                <li>{{ $detail->name }}</li>
                            @endforeach
                        </ul>
                        <div class="btn-wrap">
                            <a href="{{ route('plan.subscription', $plan->url) }}" class="btn-buy">
                                Assinar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

