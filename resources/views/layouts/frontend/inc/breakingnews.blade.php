<div class="row m-3 ">
    <div class="col-md-12" dir="rtl">
        <div class="d-flex justify-content-between align-items-center breaking-news" style="background-color: #f0f0f0">
            <div class="d-flex flex-row m-3 flex-grow-1 flex-fill justify-content-center py-2 text-white px-1 news rounded"
                style="background-color: #109cde">
                <span class="d-flex align-items-center">&nbsp;اہم خبریں</span>
            </div>
            <marquee class="news-scroll" behavior="scroll" loop="100" scrolldelay="1" scrollamount="12"
                direction="right" onmouseover="this.stop();" onmouseout="this.start();">
                <span class="dot"></span>
                @foreach ($breaking_news as $item)
                    <a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                    <span class="dot"></span>
                @endforeach

            </marquee>
        </div>
    </div>
</div>
