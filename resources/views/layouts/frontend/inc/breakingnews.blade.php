<!-- <div class="row m-3">
    <div class="col-md-12" dir="rtl">
    <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                                    <div
                                        class="d-flex flex-row mb-3 mt-3 flex-grow-1 flex-fill justify-content-center py-2 text-white px-1 news rounded test" style="background-color: #f14c38">
                                        <span class="d-flex align-items-center">&nbsp;اہم خبریں</span></div>
                                    <marquee class="news-scroll" behavior="scroll" loop="100" scrolldelay="1"
                                        scrollamount="12" direction="right" onmouseover="this.stop();"
                                        onmouseout="this.start();">
                                        @foreach ($breaking_news as $item)
                                            <a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                            <span class="dot"></span>
                                        @endforeach

                                    </marquee>
                                </div>
    </div>
</div> -->
                    <div class="container">
                        <div class="row p-lg-4">
                            <div class="col-12 rtl">
                            <h5 class="rounded p-2 text-white d-sm-block d-lg-none mt-2" style="background-color: #f14c38; float: right; z-index: -1;">&nbsp;اہم خبریں</h5>
                                <div class="d-flex justify-content-between align-items-center breaking-news bg-white pt-3 pb-3">
                                    <div
                                        class="d-flex flex-row mb-3 mt-3 flex-grow-1 flex-fill justify-content-center py-2 text-white px-1 news rounded test disply" style="background-color: #109cde">
                                        <span class="d-flex align-items-center disply">&nbsp;اہم خبریں</span></div>
                                    <marquee class="news-scroll" behavior="scroll" loop="100" scrolldelay="1"
                                        scrollamount="12" direction="right" onmouseover="this.stop();"
                                        onmouseout="this.start();">
                                        @foreach ($breaking_news as $item)
                                            <a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                            <span class="dot"></span>
                                        @endforeach

                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
